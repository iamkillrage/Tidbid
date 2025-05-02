import AgoraRTC from "agora-rtc-sdk-ng";

let rtc = {
    localAudioTrack: null,
    localVideoTrack: null,
    client: null,
};

let options = {
    appId: "e59366bc6d64449b9137b2e7c1a63209",
};

async function startVideoCall() {
    rtc.client = AgoraRTC.createClient({
        mode: "rtc",
        codec: "vp8"
    });

    rtc.client.on("user-published", async (user, mediaType) => {
        await rtc.client.subscribe(user, mediaType);

        console.log("Subscribe success!");

        if (mediaType === "video") {
            const remoteVideoTrack = user.videoTrack;

            const remotePlayerContainer = document.getElementById("streamVideo");

            remoteVideoTrack.play(remotePlayerContainer);
        }

        if (mediaType === "audio") {
            const remoteAudioTrack = user.audioTrack;

            remoteAudioTrack.play();
        }

        rtc.client.on("user-unpublished", async (user) => {
            rtc.localAudioTrack.close();
            rtc.localVideoTrack.close();

            await rtc.client.leave();

            let currentURL = window.location.href;
            if (currentURL.includes('video-chat')) {
                setTimeout(() => {
                    window.location.href = '/influencer-stream';
                }, 2000);
            } else {
                setTimeout(() => {
                    window.location.href = '/user-upcoming-stream';
                }, 2000);
            }
        });
    });

    window.onload = function () {
        const joinCall = document.getElementById("join");
        const muteCall = document.getElementById("mute");
        const leaveCall = document.getElementById("leave");
        const unmuteCall = document.getElementById("unmute");

        if (joinCall) {
            joinCall.onclick = async function () {
                const uid = joinCall.dataset.uid;
                const token = joinCall.dataset.token;
                const channel = joinCall.dataset.channel;

                await rtc.client.join(options.appId, channel, token, uid);

                rtc.localAudioTrack = await AgoraRTC.createMicrophoneAudioTrack();
                rtc.localVideoTrack = await AgoraRTC.createCameraVideoTrack();

                await rtc.client.publish([rtc.localAudioTrack, rtc.localVideoTrack]);

                const localPlayerContainer = document.getElementById("selfVideo");

                rtc.localVideoTrack.play(localPlayerContainer);

                console.log("Publish success!");
            };
        }

        if (muteCall) {
            muteCall.onclick = async () => {
                rtc.localAudioTrack.close();

                muteCall.style.setProperty('display', 'none');
                unmuteCall.style.setProperty('display', 'block');
            }
        }

        if (unmuteCall) {
            unmuteCall.onclick = async () => {
                rtc.localAudioTrack = await AgoraRTC.createMicrophoneAudioTrack();

                await rtc.client.publish([rtc.localAudioTrack]);

                muteCall.style.setProperty('display', 'block');
                unmuteCall.style.setProperty('display', 'none');
            }
        }

        if (leaveCall) {
            leaveCall.onclick = async function () {
                rtc.localAudioTrack.close();
                rtc.localVideoTrack.close();

                await rtc.client.leave();

                let currentURL = window.location.href;
                if (currentURL.includes('video-chat')) {
                    setTimeout(() => {
                        window.location.href = '/influencer-stream';
                    }, 2000);
                } else {
                    setTimeout(() => {
                        window.location.href = '/user-upcoming-stream';
                    }, 2000);
                }
            };
        }
    };
}

startVideoCall();