document.addEventListener("DOMContentLoaded", async function () {
	JsSIP.debug.enable('JsSIP:*');

	var socket = new JsSIP.WebSocketInterface('ws://192.168.5.57:5066');
	var configuration = {
		sockets : [socket],
		uri : 'sip:1000@192.168.5.57',
		password: 'Tifa2023'
	};

	const username = document.getElementById('username').innerHTML;
	const resNumber = document.getElementById('respondent_number').innerHTML;
	const ext_number = document.getElementById('extension_number').innerHTML;
	
	//respondent_number = 'sip:0788491402@192.168.5.57';
	respondent_number = 'sip:0788491402@10.66.57.75';

	console.log('Username', username);
	console.log('Respondent Number', respondent_number);

	var ua = new JsSIP.UA(configuration);
	var session; // Variable to store the call session

	// Events
	ua.on('connected', function() {
		console.log('Connected');
	});

	ua.on('disconnected', function() {
		console.log('Disconnected');
	});

	// Make a Call
	const eventHandlers = {
		'progress': function (e) {
			console.log('Call in Progress');
		},
		'failed': function (e) {
			console.log('Call Failed With Cause: ' + (e.data ? e.data.cause : 'no cause'), e);
		},
		'confirmed': function (e) {
			console.log('Call Confirmed');
		},
		'addstream': (e) => {
			console.log('Add Stream (event handlers)')
			audio.srcObject = e.stream
			audio.play()
		}
	};

	const options = {
		'eventHandlers': eventHandlers,
		'mediaConstraints': {'audio': true, 'video': false},
		'extraHeaders': [
		"X-Taskid: 13",
		"X-Interviewer: " + username,
		"X-Respondent: " + resNumber,
		], /* 13 is value from the database */
		'pcConfig': {
            'iceServers': [
                {
                    'urls': ['stun:stun.l.google.com:19302','stun:stun1.l.google.com:19302']
                }
             ]
        }
	};

	const audio = new window.Audio();

	ua.on('registered', function () {
		document.getElementById('callButton').addEventListener('click', function () {
			if (session) {
				console.log('Already in a call');
				return;
			}

			session = ua.call(respondent_number, options);

			if (session.connection) {
				console.log('Connection is Valid');
			} else {
				console.log('Connection is null');
			}

            document.getElementById('callButton').setAttribute('disabled', 'disabled');
			document.getElementById('hungupButton').removeAttribute('disabled');
		});

		document.getElementById('hungupButton').addEventListener('click', function () {
			if (session) {
				session.terminate();
				session = null;
			}

			document.getElementById('callButton').removeAttribute('disabled');
            document.getElementById('hangupButton').setAttribute('disabled', 'disabled');
		});

	});

	ua.on('newRTCSession', (data) => {
		console.log('new RTC Session');
		const session = data.session;
		session.on('addstream', function (e) {
			// Set remote audio stream (to listen to remote audio)
			// remoteAudio is <audio> element on page
			const remoteAudio = audio;
			//remoteAudio.src = window.URL.createObjectURL(e.stream);
			remoteAudio.srcObject = e.stream;
			remoteAudio.play();
		});
	});

	ua.start();
});