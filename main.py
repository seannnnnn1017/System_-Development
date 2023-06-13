import tkinter as tk
from tkinter import scrolledtext
from tkinter import messagebox
import mysql.connector as myconn
import hashlib
import threading
import socket
import time
import re
#1, 'root', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855'

def LoginWindow():
    def sha256_hash( text):
        encoded_text = text.encode('utf-8')
        sha256_hash = hashlib.sha256()
        sha256_hash.update(encoded_text)
        hashed_text = sha256_hash.hexdigest()
        return hashed_text

    def login():
        global username
        username = entry_username.get()
        password = sha256_hash(entry_password.get())

        cursor.execute(f'SELECT * FROM account')
        rows = cursor.fetchall()
        find = False
        print(rows)
        print(username,password)
        for i in rows:
            if i[1] == username:
                find = True
                if i[2] == password:
                    window.destroy()  # 關閉登入介面視窗
                    MainPage(username)  # 打開主頁面視窗
                    break
                else:
                    messagebox.showerror("登入失敗", "密碼錯誤。")
        
        if not find:
            messagebox.showinfo("登入失敗", "無此帳號")
          
    window = tk.Tk()
    window.title("登入介面")
    window.geometry('200x200')

    # 連接資料庫
    conn =myconn.connect(
            host='localhost',
            user='op',
            password='Sean23756778'
        )
    cursor = conn.cursor()
    cursor.execute("USE poject")
    # 建立使用者名稱標籤和輸入框
    label_username = tk.Label(window, text="帳號：")
    label_username.grid(row=0,column=0)
    entry_username = tk.Entry(window)
    entry_username.grid(row=1,column=0)

    # 建立密碼標籤和輸入框
    label_password = tk.Label(window, text="密碼：")
    label_password.grid(row=2,column=0)
    entry_password = tk.Entry(window, show="*")  # 顯示密碼為星號
    entry_password.grid(row=3,column=0)

    # 建立登入按鈕
    btn_login = tk.Button(window, text="登入", command=lambda:login())
    btn_login.grid(row=4,column=0)

    window.mainloop()



def ipconfig():
    s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
    s.connect(("8.8.8.8", 80))
    ip = s.getsockname()[0]
    s.close()
    return ip



def joinchatapp(host, port):
    global chat_box1

    user_name = username

    def connect():
        global client_socket
        client_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        client_socket.connect((host, int(port)))
        chat_box1.insert('end','Connected to the server.')

    def receive_messages():
        global client_socket
        while True:
            msg = client_socket.recv(1024).decode('utf-8')
            chat_box1.insert('end',msg)

    def send_message():
        message = input_box.get("1.0", "end").strip()
        if message:
            client_socket.send((user_name + ": " + message).encode())
            chat_box1.insert("end", f"You: {message}\n")
            input_box.delete("1.0", "end")

    def start():
        global client_socket
        connect()

        recv_thread = threading.Thread(target=receive_messages)
        recv_thread.start()

        send_thread = threading.Thread(target=send_message)
        send_thread.start()

        send_thread.join()
        recv_thread.join()

        client_socket.close()

    # Create the main window
    root = tk.Tk()
    root.title("Chat Room")

    # Create the chat box
    chat_box1 = scrolledtext.ScrolledText(root, width=50, height=20)
    chat_box1.pack(padx=10, pady=10)

    # Create the input box
    input_box = tk.Text(root, height=3)
    input_box.pack(padx=10, pady=5)

    # Create the send button
    send_button = tk.Button(root, text="Send", command=send_message)
    send_button.pack(pady=5)

    # Use threading to start the server
    threading.Thread(target=start).start()

    # Run the main loop
    root.mainloop()
    
def server(host, port):
    global clients
    
    host = host
    port = port

    clients = []
    history_messages = []

    def start(chat_box):
        global server_socket,conn

        server_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        server_socket.bind((host, port))
        server_socket.listen(5)
        chat_box.insert("end", f'ip:{host}   port:{port}\n')
        chat_box.insert("end", 'Server started. Waiting for connections...\n')
        print('Server started. Waiting for connections...')

        try:
            while True:
                conn, addr = server_socket.accept()
                clients.append(conn)
                client_thread = threading.Thread(target=handle_client, args=(conn, addr, chat_box))
                client_thread.start()
        except Exception as e:
            print('Error:', str(e))
            server_socket.close()

    def handle_client(conn, addr, chat_box):
        print('Connected with', addr)

        welcome_msg = 'Welcome to the chat server!'
        conn.send(welcome_msg.encode())

        try:
            while True:
                msg = conn.recv(1024).decode('utf-8')
                print(f'Received from {addr}: {msg}')
                history_messages.append([time.ctime(time.time()), addr, msg])

                if 'exit' in msg.lower():
                    msg = 'Client', addr, 'disconnected'
                    print(msg)
                    history_messages.append([time.ctime(time.time()), "server", msg])
                    response = 'Goodbye!'
                    conn.send(response.encode())
                    conn.close()
                    clients.remove(conn)
                    break
                else:
                    chat_box.insert("end", msg + '\n')
                    print(msg)

        except ConnectionResetError:
            pass
    
    threading.Thread(target=start, args=(chat_box,)).start()


def startchatapp():
    global chat_box, server_thread

    def send_message():
        message = input_box.get("1.0", "end").strip()
        if message:
            chat_box.insert("end", f"You: {message}\n")
            input_box.delete("1.0", "end")

        for conn in clients:
            conn.send(f"{username}:{message}".encode())

    def on_closing():
        for conn in clients:
            conn.send("exit".encode())  # 向所有客户端发送退出消息

        if server_thread is not None:
            server_thread.join()  # 等待服务器线程结束

        root.destroy()  # 关闭窗口

    # 创建主视窗
    root = tk.Tk()
    root.title("Chat Room")
    root.protocol("WM_DELETE_WINDOW", on_closing)  # 关闭窗口事件处理

    # 创建聊天记录框
    chat_box = scrolledtext.ScrolledText(root, width=50, height=20)
    chat_box.pack(padx=10, pady=10)

    # 创建输入框
    input_box = tk.Text(root, height=3)
    input_box.pack(padx=10, pady=5)

    # 创建发送按钮
    send_button = tk.Button(root, text="Send", command=send_message)
    send_button.pack(pady=5)

    # 开启服务器
    ip = ipconfig()

    # 用多线程开启服务器
    server_thread = threading.Thread(target=server, args=(ip, 2077))
    server_thread.start()

    # 执行主循环
    root.mainloop()


def phone_number_extraction_gui(window):
    def window_open():
        title = tk.Label(window, text="INPUT").pack()

        entry = tk.Text(
            window,
            bd=0,
            bg="#FDF7F7",
            fg="#000716",
        ) 
        entry.pack()

        output = tk.Text(
            window,
            bd=0,
        )

        def phone_numbers():
            entry_text = entry.get(1.0, tk.END)
            entry.delete(1.0, tk.END)

            phone0 = re.findall(r'(\(?\+?886\)?\s?-?\d{1,4}\s?-?\d{3,4}\s?-?\d{3,4})', entry_text)
            phone01 = re.findall(r'(09\d{8})', entry_text)
            all_phone = phone0 + phone01

            for phone in all_phone:
                output.insert(tk.END, f"{phone}\n")



        title2 = tk.Label(window, text='OUTPUT').pack(fill='both')
        output.pack()
        
        scan_button = tk.Button(
            window,
            text='scan',
            command=phone_numbers
        )
        scan_button.pack()
    window_open()
    window.mainloop()
  
def MainPage(username):
    

    def exit_app():
        if messagebox.askyesno("Exit", "Are you sure you want to exit?"):
            root.destroy()

    root = tk.Tk()
    root.title("Main Page")

    # 創建標題
    title_label = tk.Label(root, text=f"Welcome {username}", font=("Helvetica", 16))
    title_label.grid(row=0, column=0, columnspan=2, pady=20)

    # 創建按鈕

    start_chat_button = tk.Button(root, text="Start Chat", command=startchatapp)
    start_chat_button.grid(row=4, column=0, padx=20, pady=10)

    phone=tk.Button(root,text='phone number',command=lambda:phone_number_extraction_gui(tk.Tk()))
    phone.grid(row=5, column=0, padx=10)
    ip_label = tk.Label(root, text="IP:")
    ip_label.grid(row=2, column=0, padx=10)

    ip_entry = tk.Entry(root)
    ip_entry.grid(row=2, column=1, padx=10)

    port_label = tk.Label(root, text="Port:")
    port_label.grid(row=3, column=0, padx=10)

    port_entry = tk.Entry(root)
    port_entry.grid(row=3, column=1, padx=10)

    join_chat_button = tk.Button(root, text="Join Chat", command=lambda:joinchatapp(ip_entry.get(),port_entry.get()))
    join_chat_button.grid(row=4, column=1, pady=10)

    exit_button = tk.Button(root, text="Exit", command=exit_app)
    exit_button.grid(row=5, column=3, pady=10)


    # 執行主迴圈
    root.mainloop()




























LoginWindow()

