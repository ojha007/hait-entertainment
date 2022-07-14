import "../../sass/main.scss";
import "../../sass/icon.css";
import "bootstrap/js/src/carousel";
import "bootstrap/js/src/collapse";
import "bootstrap/js/src/dropdown";
import "./menu";
import "./navigation";
import "slick-carousel";
import "jquery";

$(".our-partners-slick-container").slick({
    arrows: false,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 4,
    autoplay: true,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});





