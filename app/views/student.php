<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Info by Reisbelle</title>

    <style>
        /* =================================
           GLOBAL SETTINGS
           ================================= */

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;

            font-family: Arial, Helvetica, sans-serif;

            color: #493b17;

            /* Sunflower background */
            background:
                radial-gradient(
                    circle at 10% 10%,
                    rgba(255, 211, 55, 0.30),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 90% 85%,
                    rgba(245, 194, 35, 0.18),
                    transparent 30%
                ),
                linear-gradient(
                    135deg,
                    #fff9df,
                    #f8e7a6
                );

            overflow-x: hidden;
        }


        /* =================================
           DECORATIVE FLOWERS
           ================================= */

        body::before {
            content: "🌻";

            position: fixed;
            top: 100px;
            left: -15px;

            font-size: 85px;

            opacity: 0.13;

            transform: rotate(-15deg);

            pointer-events: none;
        }

        body::after {
            content: "🌻";

            position: fixed;
            right: -20px;
            bottom: 30px;

            font-size: 100px;

            opacity: 0.12;

            transform: rotate(18deg);

            pointer-events: none;
        }


        /* =================================
           NAVBAR
           ================================= */

        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;

            display: flex;
            justify-content: center;
            align-items: center;

            gap: 8px;

            padding: 15px 20px;

            background: rgba(255, 250, 224, 0.94);

            border-bottom: 1px solid #e5c95a;

            box-shadow:
                0 5px 18px rgba(112, 82, 5, 0.10);

            backdrop-filter: blur(10px);
        }

        .navbar::before {
            content: "🌻";

            margin-right: 8px;

            font-size: 17px;
        }

        .navbar::after {
            content: "🌻";

            margin-left: 8px;

            font-size: 17px;
        }

        .navbar a {
            padding: 10px 18px;

            color: #80682d;

            text-decoration: none;

            font-size: 13px;
            font-weight: 700;

            border-radius: 25px;

            transition: all 0.25s ease;
        }

        .navbar a:hover {
            color: #654800;

            background: #fff1a9;

            transform: translateY(-2px);

            box-shadow:
                0 5px 12px rgba(128, 94, 0, 0.12);
        }


        /* =================================
           MAIN HERO
           ================================= */

        .hero {
            position: relative;

            width: 92%;
            max-width: 900px;

            margin: 70px auto 40px;

            padding: 55px 45px;

            text-align: center;

            background:
                linear-gradient(
                    145deg,
                    rgba(255, 255, 247, 0.96),
                    rgba(255, 249, 218, 0.94)
                );

            border: 1px solid #e5cb65;

            border-radius: 28px;

            box-shadow:
                0 18px 45px rgba(113, 83, 7, 0.15);

            overflow: hidden;
        }

        /* Top sunflower decoration */

        .hero::before {
            content: "🌻";

            position: absolute;

            top: -35px;
            left: -30px;

            font-size: 105px;

            opacity: 0.16;

            transform: rotate(-15deg);
        }

        .hero::after {
            content: "🌻";

            position: absolute;

            right: -35px;
            bottom: -40px;

            font-size: 120px;

            opacity: 0.14;

            transform: rotate(18deg);
        }


        /* =================================
           SMALL LABEL
           ================================= */

        .label {
            display: inline-block;

            margin-bottom: 25px;

            padding: 8px 15px;

            background: #fff4b8;

            color: #8b6807;

            border: 1px solid #e6c95b;

            border-radius: 30px;

            font-size: 11px;
            font-weight: 700;

            letter-spacing: 1px;
            text-transform: uppercase;
        }


        /* =================================
           AVATAR
           ================================= */

        .avatar {
            position: relative;

            width: 125px;
            height: 125px;

            margin: 5px auto 28px;

            display: flex;
            align-items: center;
            justify-content: center;

            background:
                linear-gradient(
                    145deg,
                    #ffd83d,
                    #e9ae08
                );

            color: #654700;

            border: 7px solid #fff2a6;

            border-radius: 50%;

            font-size: 23px;
            font-weight: 800;

            box-shadow:
                0 0 0 2px #d7a900,
                0 10px 25px rgba(147, 103, 0, 0.20);

            z-index: 2;
        }

        /* Flower petals around avatar */

        .avatar::before {
            content: "🌻";

            position: absolute;

            inset: -22px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 150px;

            opacity: 0.08;

            z-index: -1;
        }


        /* =================================
           TITLE
           ================================= */

        h1 {
            position: relative;
            z-index: 2;

            margin: 0;

            color: #654800;

            font-size: clamp(25px, 5vw, 38px);

            font-weight: 800;

            line-height: 1.3;
        }

        h1::after {
            content: "";

            display: block;

            width: 65px;
            height: 4px;

            margin: 18px auto 0;

            background: #f2c328;

            border-radius: 10px;
        }


        /* =================================
           SUBTITLE
           ================================= */

        .subtitle {
            position: relative;
            z-index: 2;

            max-width: 680px;

            margin: 25px auto 0;

            color: #7d704d;

            font-size: 15px;

            line-height: 1.8;
        }

        .subtitle strong {
            color: #987000;
        }


        /* =================================
           STATUS
           ================================= */

        .status {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            margin-top: 24px;

            color: #7b681f;

            font-size: 12px;
            font-weight: 700;
        }

        .status-dot {
            width: 9px;
            height: 9px;

            background: #75a934;

            border-radius: 50%;

            box-shadow:
                0 0 0 4px rgba(117, 169, 52, 0.14);
        }


        /* =================================
           BUTTON
           ================================= */

        .button {
            position: relative;
            z-index: 2;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            margin-top: 30px;

            padding: 15px 25px;

            background: #f5ca28;

            color: #5b4200;

            text-decoration: none;

            font-size: 13px;
            font-weight: 800;

            border: 1px solid #dda900;

            border-radius: 30px;

            box-shadow:
                0 7px 0 #d4a30a,
                0 12px 22px rgba(116, 84, 0, 0.15);

            transition: all 0.2s ease;
        }

        .button::before {
            content: "🌻";

            margin-right: 8px;

            font-size: 15px;
        }

        .button:hover {
            background: #ffd83f;

            transform: translateY(-3px);

            box-shadow:
                0 10px 0 #d4a30a,
                0 16px 25px rgba(116, 84, 0, 0.18);
        }

        .button:active {
            transform: translateY(3px);

            box-shadow:
                0 4px 0 #d4a30a;
        }


        /* =================================
           INFORMATION STRIP
           ================================= */

        .info-strip {
            display: flex;
            justify-content: center;
            align-items: center;

            gap: 12px;

            max-width: 700px;

            margin: 28px auto 0;

            padding: 13px 18px;

            background: #fff9df;

            border: 1px solid #ead58a;

            border-radius: 14px;

            color: #8b7a4c;

            font-size: 11px;
        }

        .info-strip span {
            color: #b18400;

            font-weight: 700;
        }


        /* =================================
           FOOTER
           ================================= */

        .footer {
            padding: 20px 20px 40px;

            text-align: center;

            color: #9b8954;

            font-size: 11px;

            letter-spacing: 0.5px;
        }

        .footer-decoration {
            margin-bottom: 14px;

            color: #d1a91f;

            font-size: 18px;
        }


        /* =================================
           MOBILE DESIGN
           ================================= */

        @media (max-width: 600px) {

            .navbar {
                gap: 2px;

                padding: 11px 5px;
            }

            .navbar::before,
            .navbar::after {
                display: none;
            }

            .navbar a {
                padding: 9px 10px;

                font-size: 11px;
            }

            .hero {
                width: calc(100% - 20px);

                margin: 45px auto 30px;

                padding: 40px 20px;

                border-radius: 22px;
            }

            .hero::before {
                font-size: 75px;
            }

            .hero::after {
                font-size: 85px;
            }

            .label {
                font-size: 9px;
            }

            .avatar {
                width: 100px;
                height: 100px;

                font-size: 18px;
            }

            h1 {
                font-size: 25px;
            }

            .subtitle {
                font-size: 13px;

                line-height: 1.75;
            }

            .button {
                width: 100%;

                padding: 14px 15px;

                font-size: 11px;
            }

            .info-strip {
                flex-direction: column;

                gap: 5px;

                line-height: 1.6;
            }

            .footer {
                font-size: 9px;
            }
        }


        /* =================================
           SMALL PHONES
           ================================= */

        @media (max-width: 400px) {

            .hero {
                padding: 35px 15px;
            }

            h1 {
                font-size: 22px;
            }

            .subtitle {
                font-size: 12px;
            }

            .navbar a {
                font-size: 9px;
            }
        }
    </style>
</head>

<body>


    <!-- =================================
         NAVIGATION
         ================================= -->

    <div class="navbar">

        <a href="<?= site_url('student'); ?>">
            Home
        </a>

        <a href="<?= site_url('student/profile'); ?>">
            Student Profile
        </a>

    </div>
    


    <!-- =================================
         HERO / STUDENT INTRO
         ================================= -->

    <div class="hero">

        <div class="label">
            🌻 Student Information
            
        </div>

        <h1>
            Welcome to Student Info
        </h1>


        <p class="subtitle">
            A personal student information page built with
            <strong>LavaLust</strong>.

            This includes my studies, skills, hobbies,
            interests and social media.
            <br><br>
        </p>


        <div class="status">
            <span class="status-dot"></span>
            Student Profile Active
        </div>


        <br>


        <a class="button" href="<?= site_url('student/profile'); ?>">
            Explore My Profile
        </a>


        <div class="info-strip">
            <span>🌻 Personal Profile</span>
            <span>•</span>
            <span>Studies</span>
            <span>•</span>
            <span>Skills</span>
            <span>•</span>
            <span>Interests</span>
        </div>

    </div>


    <!-- =================================
         FOOTER
         ================================= -->

    <div class="footer">

        <div class="footer-decoration">
            🌻 ✦ 🌻 ✦ 🌻
        </div>

        Student Info using LavaLust
        <br>
        By Riesbelle Villamor

    </div>

</body>
</html>
