<div class="row chat">
    <h2 class="">Диалог</h2>
    <div class="border border-secondary rounded d-flex flex-column" id="messages">
        <?php
            foreach($data['messages'] as $message) {
                $name = $message['user_id'] == $data['user_me']['id'] ?
                    $data['user_me']['fullname'] :
                    $data['user_to']['fullname'];
                echo "<div>" . $name . ": " . $message['message'] . "</div>";
            }
        ?>
    </div>
    <form class="" id="inputForm" method="POST">
        <div class="row py-2">
            <textarea class="" type="text" name="message" placeholder="Напиши сообщение: "></textarea>
            <button id="inputSubmit" class="d-none" type="submit"></button>
        </div>
        <input type="hidden" name="room_id" value="<?php echo $data['room_id'] ?>">
        <input type="hidden" name="my_id"  value="<?php echo $data['user_me']['id'] ?>">
        <input type="hidden" name="user_id"  value="<?php echo $data['user_to']['id'] ?>">
    </form>

</div>

<style>
    .chat {
        position: absolute;
        display: flex;
        flex-direction: column;
        top: 80px;
        bottom: 0;
        left: 0;
        right: 0;
        width: 600px;
        margin: 0 auto;
    }

    #messages {
        flex: 1;
        display: flex;
        word-wrap: break-word;
        overflow:scroll;
        overflow-x:hidden
    }

    #inputForm {
        flex: 0;
    }
</style>

<script>
    $(document).ready(function() {
        let block = document.getElementById("messages");
        block.scrollTop = block.scrollHeight;

        $('#inputForm').submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "/chat/postMessage",
                data: $(this).serialize(),
                success: function(res) {
                    console.log(res);
                    addMsgToChat(res);
                    $("textarea[name='message']").html(function() {
                        this.value = "";
                    });
                    let block = document.getElementById("messages");
                    block.scrollTop = block.scrollHeight;
                }
            })
        })
    });

    $("textarea[name='message']").keyup(function(event) {
        if (event.keyCode === 13) {
            $("#inputSubmit").click();
        }
    });

    function addMsgToChat(msg) {
        let div = document.createElement('div');
        div.innerHTML =  `${msg['fullname']}: ${msg['message']}`;
        let messages = document.getElementById('messages');
        messages.append(div);
        
    }
    
    my_id = document.querySelector('input[name="my_id"]').value;
    let socket = new WebSocket(`ws://127.0.0.1:8000/?my_id=${my_id}`);
    socket.onopen = function(e) {
        console.log("[open] Соединение установлено");
    };

    socket.onmessage = function(event) {
        console.log(`[message] Данные получены с сервера:`);
        let msg = JSON.parse(event.data);
        //let msg = event.data;
        addMsgToChat(msg);
    };

    socket.onclose = function(event) {
        if (event.wasClean) {
            console.log(`[close] Соединение закрыто чисто, код=${event.code} причина=${event.reason}`);
        } else {
            console.log('[close] Соединение прервано');
        }
    };

    socket.onerror = function(error) {
        console.log(error);
    };
    
</script>