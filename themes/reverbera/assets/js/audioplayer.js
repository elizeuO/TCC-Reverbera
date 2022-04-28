let audioPlayer = document.querySelectorAll('.c-audio-player');

audioPlayer.forEach(function (element) {
    initializeAudioPlayer(element)
});

//Adds functionality to the custom audio player
function initializeAudioPlayer(audioPlayer) {
    let audioBook = audioPlayer.querySelector('audio');
    let playButton = audioPlayer.querySelector('.js-playbutton');
    let muteButton = audioPlayer.querySelector('.js-mutebutton');

    let timeControlBar = audioPlayer.querySelector('.js-timecontrolbar');
    //initialize aria values of time control bar
    audioBook.addEventListener("loadedmetadata", function () {
        //fixes the duration display
        let minutes = parseInt(audioBook.duration / 60);
        let seconds = parseInt(audioBook.duration % 60);
        duration.innerHTML = minutes + ':' + seconds;

        timeControlBar.setAttribute('aria-valuemax', parseInt(audioBook.duration));
        timeControlBar.setAttribute('aria-valuenow', '0');
        timeControlBar.setAttribute('aria-valuetext', parseInt(audioBook.currentTime / 60).toString() + 'minutos e' + parseInt(audioBook.currentTime % 60).toString() + 'segundos' + ' ' + 'de' + ' ' + minutes.toString() + 'minutos e' + seconds.toString() + 'segundos');
    });
    timeControlBar.setAttribute('aria-valuemin', '0');

    let timeControlBarSize = timeControlBar.clientWidth;
    let progressBar = audioPlayer.querySelector('.js-timecontroller');
    let duration = audioPlayer.querySelector('.js-duration');
    let currentTime = audioPlayer.querySelector('.js-currenttime');

    let volumeControlBar = audioPlayer.querySelector('.js-volumecontrolbar');
    let volumeControlBarSize = volumeControlBar.clientWidth;
    let volumeController = audioPlayer.querySelector('.js-volumecontroller');

    let downloadButton = audioPlayer.getElementsByTagName('a')[0];


    playButton.addEventListener('click', function () {
        playOrPause(audioBook, playButton, timeControlBar, currentTime, timeControlBarSize, progressBar)
    });

    muteButton.addEventListener('click', function () {
        muteOrUnmute(audioBook, muteButton)
    });

    timeControlBar.addEventListener('click', function (event) {
        //mechanism to pass parameters with the event
        let additionalParameter1 = audioBook;
        let additionalParameter2 = timeControlBar;
        let additionalParameter3 = progressBar;
        let additionalParameter4 = timeControlBarSize;
        clickedTimeBar.call(this, event, additionalParameter1, additionalParameter2, additionalParameter3, additionalParameter4);
    }, false);

    timeControlBar.addEventListener('keydown', function (event) {
        //mechanism to pass parameters with the event
        let additionalParameter1 = audioBook;
        keyDownTimeBar.call(this, event, additionalParameter1);
    }, false);

    timeControlBar.addEventListener('keypressed', function (event) {
        //mechanism to pass parameters with the event
        let additionalParameter1 = audioBook;
        keyDownTimeBar.call(this, event, additionalParameter1);
    }, false);

    volumeControlBar.addEventListener('click', function (event) {
        //mechanism to pass parameters with the event
        let additionalParameter1 = audioBook;
        let additionalParameter2 = muteButton;
        let additionalParameter3 = volumeControlBar;
        let additionalParameter4 = volumeController;
        let additionalParameter5 = volumeControlBarSize;
        clickedVolumeBar.call(this, event, additionalParameter1, additionalParameter2, additionalParameter3, additionalParameter4, additionalParameter5);
    }, false);

    volumeControlBar.addEventListener('keydown', function (event) {
        //mechanism to pass parameters with the event
        let additionalParameter1 = audioBook;
        let additionalParameter2 = muteButton;
        let additionalParameter3 = volumeControlBar;
        let additionalParameter4 = volumeController;
        let additionalParameter5 = volumeControlBarSize;
        keyDownVolumeBar.call(this, event, additionalParameter1, additionalParameter2, additionalParameter3, additionalParameter4, additionalParameter5);
    }, false);

    volumeControlBar.addEventListener('keypressed', function (event) {
        //mechanism to pass parameters with the event
        let additionalParameter1 = audioBook;
        let additionalParameter2 = muteButton;
        let additionalParameter3 = volumeControlBar;
        let additionalParameter4 = volumeController;
        let additionalParameter5 = volumeControlBarSize;
        keyDownVolumeBar.call(this, event, additionalParameter1, additionalParameter2, additionalParameter3, additionalParameter4, additionalParameter5);
    }, false);


    //adds better usabiliy when switching controlls
    muteButton.addEventListener('focus', () => enhanceAudioTips(audioBook));
    timeControlBar.addEventListener('focus', () => enhanceAudioTips(audioBook));
    volumeControlBar.addEventListener('focus', () => enhanceAudioTips(audioBook));
    downloadButton.addEventListener('focus', () => enhanceAudioTips(audioBook));


}


//Play or Pause current audiobook
function playOrPause(audioBook, playButton, timeControlBar, currentTime, timeControlBarSize, progressBar) {

    if (!audioBook.paused && !audioBook.ended) {
        audioBook.pause();
        playButton.innerHTML = "";

        //acessibility state
        playButton.setAttribute('title', 'Reproduzir audiolivro');
        playButton.setAttribute('aria-pressed', 'false');

        //stops timer
        window.clearInterval(updateTime);
    } else {
        audioBook.play();
        playButton.innerHTML = "";

        //acessibility state
        playButton.setAttribute('title', 'Pausar audiolivro');
        playButton.setAttribute('aria-pressed', 'true');

        //creates a timer
        updateTime = setInterval(() => update(audioBook, playButton, timeControlBar, currentTime, timeControlBarSize, progressBar), 500);

        //Pause others players
        let otherAudioPlayers = document.querySelectorAll('.c-audio-player');
            otherAudioPlayers.forEach((otherAudioPlayer)=>{
                let otherAudioBook = otherAudioPlayer.querySelector('audio');
                if(audioBook !== otherAudioBook){
                    let button = otherAudioPlayer.querySelector('.js-playbutton');
                    button.innerHTML = "";
                    otherAudioBook.pause();
                    
                    //acessibility state
                    button.setAttribute('title', 'Reproduzir audiolivro');
                    button.setAttribute('aria-pressed', 'false');

                }
            });
    }
}

//Mute or Unmute current audiobook
function muteOrUnmute(audioBook, muteButton) {
    if (audioBook.muted == true) {
        audioBook.muted = false;
        muteButton.innerHTML = "";

        //acessibility state
        muteButton.setAttribute('title', 'Mutar audiolivro');
        muteButton.setAttribute('aria-pressed', 'false');

    } else {
        audioBook.muted = true;
        muteButton.innerHTML = "";

        //acessibility state
        muteButton.setAttribute('title', 'Desmutar audiolivro');
        muteButton.setAttribute('aria-pressed', 'true');
    }
}

//Updates current audiobook's time
function update(audioBook, playButton, timeControlBar, currentTime, timeControlBarSize, progressBar) {
    if (!audioBook.ended) {
        let minutes = parseInt(audioBook.duration / 60);
        let seconds = parseInt(audioBook.duration % 60);
        let playedMinutes = addZero(parseInt(audioBook.currentTime / 60));
        let playedSeconds = addZero(parseInt(audioBook.currentTime % 60));
        currentTime.innerHTML = playedMinutes + ':' + playedSeconds;

        //calculates the progress bar's width percentage based on the audiobok's current time
        let size = parseInt(audioBook.currentTime * timeControlBarSize / audioBook.duration);
        progressBar.style.width = size + 'px';

        //updates time control bar aria
        timeControlBar.setAttribute('aria-valuenow', parseInt(audioBook.currentTime));
        timeControlBar.setAttribute('aria-valuetext', parseInt(audioBook.currentTime / 60).toString() + 'minutos e' + parseInt(audioBook.currentTime % 60).toString() + 'segundos' + ' ' + 'de' + ' ' + minutes.toString() + 'minutos e' + seconds.toString() + 'segundos');

    } else {
        currentTime.innerHTML = "00:00";
        playButton.innerHTML = "";
        progressBar.style.width = '0px';
        window.clearInterval(updateTime);
    }
}

function clickedTimeBar(event, audioBook, timeControlBar, progressBar, timeControlBarSize) {
    if (!audioBook.ended) {
        //gets the position of mouse relative to the element

        let mouseX = event.pageX - timeControlBar.offsetLeft;
        //calculates the time percentage based on mouse position on element
        let newTime = mouseX * audioBook.duration / timeControlBarSize;


        audioBook.currentTime = newTime;
        progressBar.style.width = mouseX + 'px';
    }
}

//other embed
function keyDownTimeBar(key, audioBook) {
    let flag = false;
    let newTime;

    if (!audioBook.ended) {
        switch (key.keyCode) {
            //right arrow and up arrow
            case 39:
            case 38:
                //increases 5s of current time
                newTime = audioBook.currentTime + 5;
                flag = true;
                break;

            //left arrow and down arrow
            case 37:
            case 40:
                newTime = audioBook.currentTime - 5;
                flag = true;
                break;

            //home key
            case 36:
                newTime = 0;
                flag = true;
                break;

            //end key
            case 35:
                newTime = audioBook.duration;
                flag = true;
                break;

            default:
                return;
        }

        //prevents default behavior of the keys, like scroll up when pressed
        if (flag) {
            key.preventDefault();
            key.stopPropagation();
        }
        enhanceAudioTips(audioBook)
        newTime = updateTimeValue(audioBook, newTime);
    }
}

function updateTimeValue(audioBook, newTime) {
    if (newTime < 0) {
        newTime = 0;
    } else if (newTime > audioBook.duration) {
        newTime = audioBook.duration;
    }

    audioBook.currentTime = newTime;

    return newTime;

}

function clickedVolumeBar(event, audioBook, muteButton, volumeControlBar, volumeController, volumeControlBarSize) {
    if (!audioBook.ended) {

        let mouseX = event.pageX - volumeControlBar.offsetLeft;
        //calculates the time percentage based on nouse position on element
        //volume 1 equals to 100%
        let newVolume = mouseX / volumeControlBarSize;

        enhanceAudioTips(audioBook)
        newVolume = updateVolumeValue(audioBook, muteButton, newVolume);
        updateVolumeAria(volumeControlBar, newVolume);
        volumeController.style.width = mouseX + 'px';

    }
}


function keyDownVolumeBar(key, audioBook, muteButton, volumeControlBar, volumeController, volumeControlBarSize) {
    let flag = false;
    let newVolume;

    if (!audioBook.ended) {
        switch (key.keyCode) {
            //right arrow and up arrow
            case 39:
            case 38:
                //increases 1% of volume
                newVolume = audioBook.volume + .01;
                flag = true;
                break;

            //left arrow and down arrow
            case 37:
            case 40:
                newVolume = audioBook.volume - .01;
                flag = true;
                break;

            //home key
            case 36:
                newVolume = 0;
                flag = true;
                break;

            //end key
            case 35:
                newVolume = 1;
                flag = true;
                break;

            default:
                return;
        }

        //prevents default behavior of the keys, like scroll up when pressed
        if (flag) {
            key.preventDefault();
            key.stopPropagation();
        }
        newVolume = updateVolumeValue(audioBook, muteButton, newVolume);
        enhanceAudioTips(audioBook)
        updateVolumeAria(volumeControlBar, newVolume);
        volumeController.style.width = parseInt((newVolume * volumeControlBarSize)) + 'px';

    }
}

function updateVolumeValue(audioBook, muteButton, newVolume) {
    if (newVolume < 0) {
        newVolume = 0;
    } else if (newVolume > 1) {
        newVolume = 1;
    }

    audioBook.volume = newVolume;

    if (audioBook.volume == 0) {
        audioBook.muted = true;
        muteButton.innerHTML = "";

    } else {
        audioBook.muted = false;
        muteButton.innerHTML = "";

    }


    return newVolume;

}

//updates the aria-value-text and aria-valuenow of the volume control bar
function updateVolumeAria(volumeControlBar, volume) {
    let volumeValue = parseInt(volume * 100);
    let volumeText = 'volume' + volumeValue + 'por cento';

    volumeControlBar.setAttribute('aria-valuenow', volumeValue);
    volumeControlBar.setAttribute('aria-valuetext', volumeText);

}


//adds a zero when the time is smaller than ten seconds
function addZero(digit) {
    return digit < 10 ? ('0' + digit).toString() : digit.toString();
}

//pauses the audiobook when an audioplayers's elements is focused or activated to improve usability
function enhanceAudioTips(audioBook) {
    if (!audioBook.paused && !audioBook.muted && !audioBook.ended) {
        audioBook.pause();

        //plays the audiobook after 8 seconds
        setTimeout(function () {
            audioBook.play();
        }, 8000);

    }else return;
}

