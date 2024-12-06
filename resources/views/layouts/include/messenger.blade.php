<messenger>
    <script>
        let timeoutReceiver = null;
        let timeoutSender = null;

        const loadDataMessagerReceiver = async () => {
            var url = `{{ route('ajax.message-receiver') }}`;
            try {
                const response = await fetch(url);
                if (response.ok) {
                    const result = await response.text();
                    document.getElementById("messenger-receiver").innerHTML = result;
                } else {
                    console.error("Failed to fetch data:", response.status);
                }
            } catch (error) {
                console.error("Error:", error);
            }
        };
        const loadDataMessagerSender = async (receiver) => {
            var url = `{{ route('ajax.message-sender') }}?receiver=${receiver}`;
            try {
                const response = await fetch(url);
                if (response.ok) {
                    const result = await response.text();
                    document.getElementById("messenger-sender").innerHTML = result;
                } else {
                    console.error("Failed to fetch data:", response.status);
                }
            } catch (error) {
                console.error("Error:", error);
            }
        };

        const loadTimeOutReceiver = () => {
            if (timeoutReceiver) {
                clearTimeout(timeoutReceiver);
            }
            timeoutReceiver = setTimeout(() => {
                loadDataMessagerReceiver();
            }, 200);
        };
        const loadTimeOutSender = (receiver) => {
            if (timeoutSender) {
                clearTimeout(timeoutSender);
            }
            timeoutSender = setTimeout(() => {
                loadDataMessagerSender(receiver);
                //loadDataMessagerReceiver();
            }, 200);
        };
        const sendMessage = async () => {
            // Lấy các giá trị từ form
            const sender = document.querySelector('input[name="sender"]').value;
            const receiver = document.querySelector('input[name="receiver"]').value;
            const messageInput = document.querySelector('input[name="message"]');
            const message = messageInput.value.trim();

            // Kiểm tra nếu tin nhắn rỗng
            if (!message) {
                alert("Message cannot be empty!");
                return;
            }

            const url = `{{ route('send-message') }}`; // Thay bằng route của bạn
            const data = {
                sender,
                receiver,
                message
            };

            try {
                // Gửi request POST
                const response = await fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                            .content, // Thêm CSRF token
                    },
                    body: JSON.stringify(data),
                });

                if (response.ok) {
                    const result = await response.json();

                    // Xử lý phản hồi thành công
                    loadDataMessagerSender(receiver);
                    // const messageDiv = document.createElement("div");
                    // messageDiv.className = "text-end";

                    // // Nội dung tin nhắn (thời gian và nội dung)
                    // messageDiv.innerHTML = `
                //     <div class="text-secondary" style="font-size: 10px">${new Date().toLocaleString()}</div>
                //     <div class="bg-white p-2" style="font-size: 13px">${result.message.message}</div>
                // `;

                    // // Thêm phần tử vào đầu danh sách tin nhắn
                    // const messageContainer = document.getElementById("receive-messages");
                    // messageContainer.prepend(messageDiv);

                    messageInput.value = ""; // Xóa nội dung ô nhập
                } else {
                    // Xử lý lỗi từ server
                    console.error("Error:", response.status);
                    alert("Failed to send message. Please try again.");
                }
            } catch (error) {
                // Xử lý lỗi kết nối
                console.error("Error:", error);
                alert("An error occurred. Please try again.");
            }
        };
        const sendSupplier = async (receiver) => {
            const url = `{{ route('send-supplier') }}`; // Thay bằng route của bạn
            const data = {
                receiver,
            };

            try {
                // Gửi request POST
                const response = await fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                            .content, // Thêm CSRF token
                    },
                    body: JSON.stringify(data),
                });

                if (response.ok) {
                    const result = await response.json();
                    // Xử lý phản hồi thành công
                    showMessenger();
                    loadDataMessagerSender(receiver);
                    loadDataMessagerReceiver();
                } else {
                    // Xử lý lỗi từ server
                    console.error("Error:", response.status);
                    alert("Failed to send message. Please try again.");
                }
            } catch (error) {
                // Xử lý lỗi kết nối
                console.error("Error:", error);
                alert("An error occurred. Please try again.");
            }
        };
        const sendCustomer = async (receiver) => {
            const url = `{{ route('send-customer') }}`; // Thay bằng route của bạn
            const data = {
                receiver,
            };

            try {
                // Gửi request POST
                const response = await fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                            .content, // Thêm CSRF token
                    },
                    body: JSON.stringify(data),
                });

                if (response.ok) {
                    const result = await response.json();
                    // Xử lý phản hồi thành công
                    showMessenger();
                    loadDataMessagerSender(receiver);
                    loadDataMessagerReceiver();
                } else {
                    // Xử lý lỗi từ server
                    console.error("Error:", response.status);
                    alert("Failed to send message. Please try again.");
                }
            } catch (error) {
                // Xử lý lỗi kết nối
                console.error("Error:", error);
                alert("An error occurred. Please try again.");
            }
        };
    </script>


    <div id="mess-show" onclick="showMessenger()"
        class="p-2 px-4 border border-2 border-dark border-bottom-0 btn btn-light"
        style="display: block;position: fixed; bottom: 0; right:10%;z-index: 10;">
        <div onclick="showMessenger()">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-chat-right-text" viewBox="0 0 16 16">
                <path
                    d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z" />
                <path
                    d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5" />
            </svg>
            Messenger
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-caret-up-fill" viewBox="0 0 16 16">
                <path
                    d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z" />
            </svg>
        </div>
    </div>
    <div id="mess-block" class="bg-white"
        style="display: none;position: fixed; bottom: 0; right:10%;width: 50%; z-index: 10;">
        <div class="row border border-dark m-0">
            <div class="col-md-6 p-0 border-end d-flex flex-column bg-grey">
                <div class="p-3 border-bottom border">
                    Chat Windows
                </div>
                <div style="height: 400px;background-color: rgba(255, 255, 255, 0.08);" class="d-flex flex-column gap-2"
                    id="messenger-sender">

                </div>
            </div>
            <div class="col-md-6 m-0 p-0">
                <div onclick="hiddenMessenger()" class="p-3 d-flex justify-content-between border">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-chat-right-text" viewBox="0 0 16 16">
                            <path
                                d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z" />
                            <path
                                d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5" />
                        </svg>
                        Messenger
                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                        <path
                            d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                    </svg>
                </div>
                <div class="p-3 overflow-y-scroll d-flex flex-column gap-2" style="height: 400px;"
                    id="messenger-receiver">

                </div>
            </div>
        </div>
    </div>
    <script>
        function hiddenMessenger() {
            let messShow = document.getElementById('mess-show');
            let messBlock = document.getElementById('mess-block');
            messShow.style.display = 'block';
            messBlock.style.display = 'none';
        }

        function showMessenger() {
            let messShow = document.getElementById('mess-show');
            let messBlock = document.getElementById('mess-block');
            messShow.style.display = 'none';
            messBlock.style.display = 'block';
        }
        loadDataMessagerReceiver();
    </script>
    @if (auth()->check())
        <script>
            // Lấy ID của người dùng hiện tại
            const receiverId = {{ auth()->id() }};

            // Khởi tạo Pusher
            var pusher = new Pusher('02ef1e7926b3c8debda3', {
                cluster: 'mt1',
                authEndpoint: '/broadcasting/auth', // Laravel cung cấp endpoint này
                auth: {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content') // Gửi CSRF Token để xác thực
                    }
                }
            });

            // Đăng ký kênh riêng tư
            var channel = pusher.subscribe('private-chat.' + receiverId);

            // Lắng nghe sự kiện 'NewMessageEvent'
            channel.bind('NewMessageEvent', function(data) {
                loadDataMessagerReceiver(); // Gọi hàm để tải dữ liệu tin nhắn của người nhận
                if (document.getElementById('receiver') != null) {
                    // Tải dữ liệu tin nhắn của người gửi nếu receiver tồn tại
                    loadDataMessagerSender(document.getElementById('receiver').value);
                }
                console.log('listend:', data);
            });
        </script>
    @endif
</messenger>
