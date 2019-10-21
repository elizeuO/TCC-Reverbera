class VideoManager {
    static makeIframe(ev) {
        let iframe = document.createElement("iframe");
        let embed = "https://www.youtube.com/embed/" + ev.target.parentNode.dataset.id + "?ecver=2&autoplay=1&modestbranding=1&rel=0&showinfo=0&autohide=1";

        iframe.setAttribute("frameborder", "0");
        iframe.setAttribute("allowfullscreen", "1");
        iframe.setAttribute("src", embed);

        ev.target.parentNode.replaceChild(iframe, ev.target);
    }
}

