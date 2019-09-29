
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
    let timeControlBarSize = timeControlBar.clientWidth;
    let progressBar = audioPlayer.querySelector('.js-timecontroller');
    let duration = audioPlayer.querySelector('.js-duration');
    let currentTime = audioPlayer.querySelector('.js-currenttime');

    let volumeControlBar = audioPlayer.querySelector('.js-volumecontrolbar');
    let volumeControlBarSize = volumeControlBar.clientWidth;
    let volumeController = audioPlayer.querySelector('.js-volumecontroller');


    audioBook.addEventListener("loadedmetadata", function () {
        //you can display the duration now
        let minutes = parseInt(audioBook.duration / 60);
        let seconds = parseInt(audioBook.duration % 60);
        duration.innerHTML = minutes + ':' + seconds;
    });


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

    volumeControlBar.addEventListener('click', function (event) {
        //mechanism to pass parameters with the event
        let additionalParameter1 = audioBook;
        let additionalParameter2 = muteButton;
        let additionalParameter3 = volumeControlBar;
        let additionalParameter4 = volumeController;
        let additionalParameter5 = volumeControlBarSize;
        clickedVolumeBar.call(this, event, additionalParameter1, additionalParameter2, additionalParameter3, additionalParameter4,additionalParameter5);
    }, false);

    volumeControlBar.addEventListener('keydown', function (event) {
        //mechanism to pass parameters with the event
        let additionalParameter1 = audioBook;
        let additionalParameter2 = muteButton;
        let additionalParameter3 = volumeControlBar;
        let additionalParameter4 = volumeController;
        let additionalParameter5 = volumeControlBarSize;
        keyDownVolumeBar.call(this, event, additionalParameter1, additionalParameter2, additionalParameter3, additionalParameter4,additionalParameter5);
    }, false);

    volumeControlBar.addEventListener('keypressed', function (event) {
        //mechanism to pass parameters with the event
        let additionalParameter1 = audioBook;
        let additionalParameter2 = muteButton;
        let additionalParameter3 = volumeControlBar;
        let additionalParameter4 = volumeController;
        let additionalParameter5 = volumeControlBarSize;
        keyDownVolumeBar.call(this, event, additionalParameter1, additionalParameter2, additionalParameter3, additionalParameter4,additionalParameter5);
    }, false);

    //TODO: ADAPTAR NO BACKEND
    // document.getElementById('download').setAttribute('href','https://ia800704.us.archive.org/34/items/contos_do_norte_1812_librivox/contosdonorte_0_marquesdecarvalho_128kb.mp3');
    // document.getElementById('download').setAttribute('download','contos.mp3');

}

//Play or Pause current audiobook
function playOrPause(audioBook, playButton, timeControlBar, currentTime, timeControlBarSize, progressBar) {

    // //TODO:pause all others audiobooks before start playing
    // let audioBooksList = document.querySelectorAll('audio');
    // audioBooksList.forEach(function (element){
    //     element.pause();
    // });


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
    }
}

//Mute or Unmute current audiobook
function muteOrUnmute(audioBook, muteButton) {
    if ((audioBook.muted == true) {
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
        let playedMinutes = addZero(parseInt(audioBook.currentTime / 60));
        let playedSeconds = addZero(parseInt(audioBook.currentTime % 60));
        currentTime.innerHTML = playedMinutes + ':' + playedSeconds;

        //calculates the progress bar's width percentage based on the audiobok's current time
        let size = parseInt(audioBook.currentTime * timeControlBarSize / audioBook.duration);
        progressBar.style.width = size + 'px';

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
        //calculates the time percentage based on nouse position on element
        let newTime = mouseX * audioBook.duration / timeControlBarSize;


        audioBook.currentTime = newTime;
        progressBar.style.width = mouseX + 'px';
    }
}

function clickedVolumeBar(event, audioBook, muteButton,volumeControlBar, volumeController, volumeControlBarSize){
    if(!audioBook.ended){

        let mouseX = event.pageX - volumeControlBar.offsetLeft;
        //calculates the time percentage based on nouse position on element
        //volume 1 equals to 100%
        let newVolume = mouseX  / volumeControlBarSize;


        newVolume = updateVolumeValue(audioBook, muteButton, newVolume);
        volumeController.style.width = mouseX + 'px';

    }


}


function keyDownVolumeBar(key, audioBook, muteButton,volumeControlBar, volumeController, volumeControlBarSize){
    let flag = false;
    let newVolume;


    if(!audioBook.ended){
        console.log('chegou')
        switch(key.keyCode){
            //right arrow and up arrow
            case 39:
            case 38:
                //increases 1% of volume
                newVolume = audioBook.volume+.01;
                flag = true;
                break;

            //left arrow and down arrow
            case 37:
            case 40:
                newVolume = audioBook.volume-.01;
                flag = true;
                break;

            //home key
            case 36:
                newVolume = 0;
                flag = true;
                break;

            //end key
            case 35:
                newVolume= 1;
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
        volumeController.style.width = parseInt((newVolume*volumeControlBarSize)) + 'px';

    }
}


function updateVolumeValue(audioBook, muteButton, newVolume){
    if(newVolume<0){
        newVolume=0;
    }else if(newVolume>1){
        newVolume=1;
    }

    audioBook.volume = newVolume;

    if(audioBook.volume == 0){
        audioBook.muted = true;
        muteButton.innerHTML = "";
    }else{
        audioBook.muted = false;
        muteButton.innerHTML = "";}

    updateVolumeAria(volumeControlBar, audioBook.volume);

    return newVolume;

}

//updates the aria-value-text and aria-valuenow of the volume control bar
function updateVolumeAria(volumeControlBar, volume){
    let volumeValue= parseInt(volume*100);
    let volumeText = 'volume'+volumeValue+'por cento';

    volumeControlBar.setAttribute('aria-valuenow',volumeValue);
    volumeControlBar.setAttribute('aria-valuetext',volumeText);
}





//adds a zero when the time is smaller than ten seconds
function addZero(digit) {
    return digit < 10 ? ('0' + digit).toString() : digit.toString();
}

