import AgoraRTC from "agora-rtc-sdk-ng";

let rtc = {
    client: null,
    localAudioTrack: null,
    localVideoTrack: null,
};

let options = {
    appId: "e59366bc6d64449b9137b2e7c1a63209"
};

async function loadStreamingData() {
    rtc.client = AgoraRTC.createClient({
        mode: "live",
        codec: "vp8",
        clientRoleOptions: {
            level: 2
        }
    });

    window.onload = () => {
        const startStream = document.getElementById('start-stream');
        const stopStream = document.getElementById('stop-stream');
        const joinStream = document.getElementById('join-stream');

        if (startStream) {
            startStream.onclick = async () => {
                const channel = startStream.dataset.channel;
                const token = startStream.dataset.token;
                const uid = startStream.dataset.uid;

                rtc.client.setClientRole("host");
                await rtc.client.join(options.appId, channel, token, uid);

                rtc.localAudioTrack = await AgoraRTC.createMicrophoneAudioTrack();
                rtc.localVideoTrack = await AgoraRTC.createCameraVideoTrack();

                await rtc.client.publish([rtc.localAudioTrack, rtc.localVideoTrack]);

                const localPlayerContainer = document.getElementById('streamVideo');

                rtc.localVideoTrack.play(localPlayerContainer);

                console.log("publish success!");
            }
        }

        if (stopStream && rtc.client) {
            stopStream.onclick = async () => {
                rtc.localAudioTrack.close();
                rtc.localVideoTrack.close();

                // Leave the channel.
                await rtc.client.leave();
            }
        }

        if (joinStream) {
            joinStream.onclick = async () => {
                const channel = joinStream.dataset.channel;
                const token = joinStream.dataset.token;
                const uid = joinStream.dataset.uid;

                rtc.client.setClientRole("audience");
                await rtc.client.join(options.appId, channel, token, uid);

                rtc.client.on("user-published", async (user, mediaType) => {
                    await rtc.client.subscribe(user, mediaType);

                    if (mediaType === "video") {
                        const remoteVideoTrack = user.videoTrack;

                        const remotePlayerContainer = document.getElementById('streamVideo');

                        remoteVideoTrack.play(remotePlayerContainer);
                    }

                    if (mediaType === "audio") {
                        const remoteAudioTrack = user.audioTrack;

                        remoteAudioTrack.play();
                    }

                    console.log("Subscribe success");
                });

                rtc.client.on("user-unpublished", user => {
                    // Something here
                });
            }
        }
    }
};

loadStreamingData();