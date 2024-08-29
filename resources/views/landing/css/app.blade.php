<style>
    .dark-background {
        --background-color: #2a2c39;
        --default-color: #ffffff;
        --heading-color: #ffffff;
        --surface-color: #404356;
        --contrast-color: #ffffff;
    }

    section,
    .section {
        color: var(--default-color);
        background-color: var(--background-color);
        padding: 60px 0;
        scroll-margin-top: 77px;
        overflow: clip;
    }

    /*--------------------------------------------------------------
# Global Section Titles
--------------------------------------------------------------*/
    .section-title {
        padding-bottom: 60px;
        position: relative;
    }

    .section-title h2 {
        font-size: 14px;
        font-weight: 500;
        padding: 0;
        line-height: 1px;
        margin: 0;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: color-mix(in srgb, var(--default-color), transparent 50%);
        position: relative;
    }

    .section-title h2::after {
        content: "";
        width: 120px;
        height: 1px;
        display: inline-block;
        background: var(--accent-color);
        margin: 4px 10px;
    }

    .section-title p {
        color: var(--heading-color);
        margin: 0;
        font-size: 28px;
        font-weight: 700;
        text-transform: uppercase;
        font-family: var(--heading-font);
    }

    .hero {
        width: 100%;
        overflow: hidden;
        position: relative;
        background: linear-gradient(0deg, var(--background-color) 0%, color-mix(in srgb, var(--background-color) 90%, white 10%) 100%);
        padding: 0;
        display: flex;
        flex-direction: column;
        justify-content: end;
        align-items: center;
    }

    .hero .carousel-container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        text-align: center;
        position: relative;
        min-height: 20vh;
        padding-top: 60px;
    }

    .hero h2 {
        margin-bottom: 30px;
        font-size: 48px;
        font-weight: 700;
    }

    .hero h2 span {
        text-decoration: underline;
    }

    .hero p {
        max-width: 80%;
        animation-delay: 0.4s;
        margin: 0 auto 30px auto;
    }

    /* .hero .carousel-control-prev,
    .hero .carousel-control-next {
        width: 10%;
    }

    .hero .carousel-control-next-icon,
    .hero .carousel-control-prev-icon {
        background: none;
        font-size: 48px;
        line-height: 1;
        width: auto;
        height: auto;
    } */

    .hero .btn-get-started {
        font-weight: 500;
        font-size: 14px;
        letter-spacing: 1px;
        display: inline-block;
        padding: 12px 32px;
        border-radius: 50px;
        transition: 0.5s;
        line-height: 1;
        margin: 10px;
        animation-delay: 0.8s;
        color: var(--default-color);
        border: 2px solid var(--accent-color);
    }

    .hero .btn-get-started:hover {
        background: var(--accent-color);
        color: var(--contrast-color);
        text-decoration: none;
    }

    @media (min-width: 1024px) {
        .hero p {
            max-width: 60%;
        }

        /* .hero .carousel-control-prev,
        .hero .carousel-control-next {
            width: 5%;
        } */
    }

    @media (max-width: 768px) {
        .hero .carousel-container {
            min-height: 90vh;
        }

        .hero h2 {
            font-size: 28px;
        }
    }

    .hero .hero-waves {
        display: block;
        width: 100%;
        height: 60px;
        position: relative;
    }

    .hero .wave1 use {
        animation: move-forever1 10s linear infinite;
        animation-delay: -2s;
        fill: var(--default-color);
        opacity: 0.6;
    }

    .hero .wave2 use {
        animation: move-forever2 8s linear infinite;
        animation-delay: -2s;
        fill: var(--default-color);
        opacity: 0.4;
    }

    .hero .wave3 use {
        animation: move-forever3 6s linear infinite;
        animation-delay: -2s;
        fill: var(--default-color);
    }
</style>
