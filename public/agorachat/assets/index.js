import AC from 'agora-chat'

const appKey = "611193818#1381443";

const conn = new AC.connection({
    appKey: appKey,
});

// Get current TimeStamp
function currentTime() {
    var currentdate = new Date();

    var hours = currentdate.getHours();
    var minutes = currentdate.getMinutes();
    var ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12;
    minutes = minutes < 10 ? '0' + minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;

    return strTime;
}

conn.addEventHandler("connection&message", {
    onConnected: () => {
        console.log('Connected');
    },
    onDisconnected: () => {
        console.log('Disconnected');
    },
    onTextMessage: (data) => {
        const channel = document.getElementById("channelId");

        if (channel) {
            let channelId = channel.value.toString();
            if (channelId == data.ext.channelId) {
                let messageBox = `<div class="message frnd-message">
                    <div class="userimg"><img src="https://tidbidadmin.tgastaging.com/Influencer/images/userinflu_img1.png" alt=""></div>
                    <div class="usertext">
                        <p>` + data.msg + `</p>
                        <span>`+ currentTime() + `</span>
                    </div>
                </div>`;

                $('.message-Aria').append(messageBox);

                const innerCard = document.getElementById('style-2');

                innerCard.scrollTo(0, innerCard.scrollHeight);
            }
        }
    },
    onTokenWillExpire: (params) => {
        // 
    },
    onTokenExpired: (params) => {
        // 
    },
    onError: (error) => {
        console.log(error);
    },
});

window.onload = function () {
    const connect = document.getElementById("connect");
    const disconnect = document.getElementById("disconnect");
    const sendMessage = document.getElementById("sendMessage");

    if (connect) {
        connect.onclick = function () {
            const uid = connect.dataset.uid;
            const token = connect.dataset.token;

            conn.open({
                user: uid,
                agoraToken: token,
            });
        };
    }

    if (disconnect) {
        disconnect.onclick = function () {
            conn.close();
        };
    }

    if (sendMessage) {
        sendMessage.onclick = function () {
            let peerId = document.getElementById("peerId").value.toString();
            let message = document.getElementById("message").value.toString();
            let channelId = document.getElementById("channelId").value.toString();

            let option = {
                chatType: "singleChat",
                type: "txt",
                to: peerId,
                msg: message,
                ext: { channelId }
            };

            let msgData = AC.message.create(option);

            conn.send(msgData)
                .then((response) => {
                    console.log(response)
                })
                .catch(() => {
                    console.log("Something went wrong.");
                });
        };
    }
};
