import socket
import threading

def joinchat(ip,port):


    host = ip


    client_socket = None
    user_name = input('Enter your name: ')

    def connect():
        global client_socket
        client_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        client_socket.connect((host, port))
        print('Connected to the server.')

    def receive_messages():
        global client_socket
        while True:
            msg = client_socket.recv(1024).decode('utf-8')
            print(msg)

    def send_messages():
        global client_socket
        while True:
            msg = user_name + ': ' + input()
            client_socket.send(msg.encode())
            if msg.lower() == 'exit':
                break

    def start():
        global client_socket
        connect()

        recv_thread = threading.Thread(target=receive_messages)
        recv_thread.start()

        send_thread = threading.Thread(target=send_messages)
        send_thread.start()

        send_thread.join()
        recv_thread.join()

        client_socket.close()

    start()
  
joinchat('localhost',2077)
