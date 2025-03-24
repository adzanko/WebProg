$(document).ready(function() {
    var app = $.spapp({
        defaultView: "homepage",
        templateDir: ""
    });

    app.route({
        view: "homepage",
        load: "pages/homepage.html",
        onCreate: function() {
            console.log("Homepage loaded");
        },
        onReady: function() {
            showOnly("homepage");
        }
    });

    app.route({
        view: "signup",
        load: "pages/signup.html",
        onCreate: function() {
            console.log("Signup page loaded");
        },
        onReady: function() {
            showOnly("signup");
        }
    });

    app.route({
        view: "login",
        load: "pages/login.html",
        onCreate: function() {
            console.log("Login page loaded");
        },
        onReady: function() {
            showOnly("login");
        }
    });

    app.route({
        view: "quiz",
        load: "pages/quizComponent.html",
        onCreate: function () {
            console.log("Quiz page loaded");
        },
        onReady: function () {
            showOnly("quiz");
            initQuiz(); // Call the function to ensure quiz loads properly
        }
    });
    

    app.route({
        view: "explore",
        load: "pages/explore.html",
        onCreate: function() {
            console.log("Explore page loaded");
        },
        onReady: function() {
            showOnly("explore");
        }
    });

    app.run();
    console.log("SPApp initialized");

    function showOnly(view) {
        $("#spapp > section").hide(); // Sakrij sve sekcije
        $("#" + view).show(); // Prikaži samo aktivnu sekciju
    }
});
