$("#logo").find(".st1").css("fill", "none");
$("#logo").find(".st3").css("fill", "none");
$("#logo").find(".st0").css("fill", "none");
$("#logo").find(".st2").css("fill", "none");

const logoFR = new Vivus('logoFR', {
    duration: 300,
    type: 'oneByOne',
}, function() {
    if (logoFR.getStatus() === "start") {

        $("#logo").find(".st1").css("fill", "none");
        $("#logo").find(".st3").css("fill", "none");

        logoFR.play(1);
    }
    if (logoFR.getStatus() === "end") {
        $("#logo").find(".st1").css("fill", "#E30613");
        $("#logo").find(".st3").css("fill", "#000");
        logoFR.play(-1);


    }


});

const logoAR = new Vivus('logoAR', {
    duration: 300,
    type: 'oneByOne',
    reverseStack: true,

}, function() {
    if (logoAR.getStatus() === "start") {

        $("#logo").find(".st0").css("fill", "none");
        $("#logo").find(".st2").css("fill", "none");

        logoAR.play(1);
    }
    if (logoAR.getStatus() === "end") {
        $("#logo").find(".st0").css("fill", "#E30613");
        $("#logo").find(".st2").css("fill", "#000");
        logoAR.play(-1);


    }


});