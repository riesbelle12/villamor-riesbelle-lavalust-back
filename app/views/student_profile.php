<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Profile by Riesbelle</title>

    <style>
        /* =================================
           GLOBAL SETTINGS
        ================================= */

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            min-height: 100vh;

            font-family: Arial, Helvetica, sans-serif;

            color: #493b17;

            background:
                radial-gradient(
                    circle at 8% 10%,
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
           BACKGROUND SUNFLOWERS
        ================================= */

        body::before {
            content: "🌻";

            position: fixed;

            top: 90px;
            left: -25px;

            font-size: 100px;

            opacity: 0.12;

            transform: rotate(-15deg);

            pointer-events: none;
        }

        body::after {
            content: "🌻";

            position: fixed;

            right: -30px;
            bottom: 40px;

            font-size: 120px;

            opacity: 0.11;

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

            background: rgba(255, 250, 224, 0.95);

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
           MAIN PROFILE CONTAINER
        ================================= */

        .profile {
            position: relative;

            width: 92%;
            max-width: 950px;

            margin: 50px auto 70px;
        }


        /* =================================
           PROFILE HEADER
        ================================= */

        .header-card {
            position: relative;

            overflow: hidden;

            padding: 48px 35px;

            margin-bottom: 25px;

            text-align: center;

            background:
                linear-gradient(
                    145deg,
                    rgba(255, 255, 247, 0.97),
                    rgba(255, 248, 215, 0.96)
                );

            border: 1px solid #e3c85d;

            border-radius: 25px;

            box-shadow:
                0 15px 38px rgba(113, 83, 7, 0.14);
        }

        .header-card::before {
            content: "🌻";

            position: absolute;

            top: -35px;
            left: -25px;

            font-size: 110px;

            opacity: 0.13;

            transform: rotate(-15deg);
        }

        .header-card::after {
            content: "🌻";

            position: absolute;

            right: -30px;
            bottom: -45px;

            font-size: 125px;

            opacity: 0.12;

            transform: rotate(18deg);
        }


        /* =================================
           PROFILE LABEL
        ================================= */

        .profile-label {
            position: relative;
            z-index: 2;

            display: inline-block;

            margin-bottom: 25px;

            padding: 8px 15px;

            background: #fff3b2;

            color: #8b6807;

            border: 1px solid #e4c858;

            border-radius: 30px;

            font-size: 10px;
            font-weight: 800;

            letter-spacing: 1px;
            text-transform: uppercase;
        }


        /* =================================
           AVATAR
        ================================= */

        .avatar {
            position: relative;
            z-index: 2;

            width: 125px;
            height: 125px;

            margin: 0 auto 27px;

            display: flex;
            align-items: center;
            justify-content: center;

            background:
                linear-gradient(
                    145deg,
                    #ffd83d,
                    #e8ad08
                );

            color: #654700;

            border: 7px solid #fff0a0;

            border-radius: 50%;

            font-size: 24px;
            font-weight: 800;

            box-shadow:
                0 0 0 2px #d7a900,
                0 10px 25px rgba(147, 103, 0, 0.20);
        }

        .avatar::before {
            content: "🌻";

            position: absolute;

            inset: -20px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 150px;

            opacity: 0.07;

            z-index: -1;
        }


        /* =================================
           PROFILE TITLE
        ================================= */

        h1 {
            position: relative;
            z-index: 2;

            margin: 0;

            color: #654800;

            font-size: clamp(23px, 4vw, 34px);

            font-weight: 800;

            line-height: 1.35;
        }

        h1::after {
            content: "";

            display: block;

            width: 65px;
            height: 4px;

            margin: 16px auto 0;

            background: #f2c328;

            border-radius: 10px;
        }

        .subtitle {
            position: relative;
            z-index: 2;

            margin: 17px 0 0;

            color: #8b773f;

            font-size: 14px;

            letter-spacing: 0.4px;
        }


        /* =================================
           PROFILE CARDS
        ================================= */

        .card {
            position: relative;

            margin-bottom: 22px;

            padding: 27px;

            background:
                rgba(255, 255, 250, 0.92);

            border: 1px solid #e4d28b;

            border-radius: 20px;

            box-shadow:
                0 10px 28px rgba(113, 83, 7, 0.10);

            transition: all 0.25s ease;
        }

        .card:hover {
            transform: translateY(-3px);

            border-color: #d7b83e;

            box-shadow:
                0 15px 32px rgba(113, 83, 7, 0.14);
        }

        .card h2 {
            display: flex;
            align-items: center;
            gap: 10px;

            margin: 0 0 20px;

            padding-bottom: 14px;

            color: #684c05;

            font-size: 17px;
            font-weight: 800;

            border-bottom: 1px solid #eadb9c;
        }

        .card h2::before {
            content: "🌻";

            font-size: 19px;
        }


        /* =================================
           INFORMATION ROWS
        ================================= */

        .info {
            display: grid;

            grid-template-columns: 180px 1fr;

            gap: 25px;

            padding: 15px 7px;

            border-bottom: 1px solid #f0e7c8;

            transition: background 0.2s ease;
        }

        .info:hover {
            background: #fff9df;

            border-radius: 10px;
        }

        .info:last-child {
            border-bottom: none;
        }

        .label {
            color: #a07700;

            font-size: 11px;
            font-weight: 800;

            letter-spacing: 0.7px;

            text-transform: uppercase;
        }

        .label::before {
            content: "• ";

            color: #e0b51b;
        }

        .value {
            color: #5d543a;

            font-size: 14px;

            line-height: 1.6;

            word-break: break-word;
        }


        /* =================================
           ABOUT ME
        ================================= */

        .about {
            margin: 0 0 18px;

            padding: 19px;

            background: #fff9df;

            color: #756947;

            border: 1px solid #eee1ac;

            border-radius: 13px;

            font-size: 14px;

            line-height: 1.8;
        }

        .about::before {
            content: "ABOUT ME";

            display: block;

            margin-bottom: 9px;

            color: #a47700;

            font-size: 10px;
            font-weight: 800;

            letter-spacing: 1px;
        }


        /* =================================
           SKILLS & HOBBIES
        ================================= */

        .tag-value {
            display: inline-block;

            padding: 7px 12px;

            background: #fff2ac;

            color: #805e00;

            border: 1px solid #e5c75b;

            border-radius: 20px;

            font-size: 12px;
            font-weight: 700;
        }


        /* =================================
           SOCIAL MEDIA
        ================================= */

        .social-links {
            display: flex;

            gap: 12px;

            flex-wrap: wrap;
        }

        .social-links a {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-width: 120px;

            padding: 13px 20px;

            background: #fff8d7;

            color: #866200;

            text-decoration: none;

            border: 1px solid #dfc458;

            border-radius: 25px;

            font-size: 12px;
            font-weight: 800;

            transition: all 0.25s ease;
        }

        .social-links a::before {
            content: "🌻";

            margin-right: 7px;

            font-size: 14px;
        }

        .social-links a:hover {
            background: #f5ca28;

            color: #5b4200;

            transform: translateY(-3px);

            box-shadow:
                0 7px 15px rgba(125, 91, 0, 0.15);
        }


        /* =================================
           BACK BUTTON
        ================================= */

        .back-button {
            display: flex;

            align-items: center;
            justify-content: center;

            width: fit-content;

            margin: 35px auto 0;

            padding: 14px 24px;

            background: #f5ca28;

            color: #5b4200;

            text-decoration: none;

            border: 1px solid #dca900;

            border-radius: 30px;

            font-size: 12px;
            font-weight: 800;

            box-shadow:
                0 6px 0 #d4a30a,
                0 10px 20px rgba(116, 84, 0, 0.12);

            transition: all 0.2s ease;
        }

        .back-button::before {
            content: "←";

            margin-right: 8px;

            font-size: 16px;
        }

        .back-button:hover {
            background: #ffd83f;

            transform: translateY(-3px);

            box-shadow:
                0 9px 0 #d4a30a,
                0 14px 24px rgba(116, 84, 0, 0.15);
        }


        /* =================================
           FOOTER
        ================================= */

        .footer {
            margin-top: 35px;

            padding: 20px;

            text-align: center;

            color: #9a8955;

            font-size: 11px;
        }

        .footer-decoration {
            margin-bottom: 10px;

            color: #d1a91f;

            font-size: 18px;
        }


        /* =================================
           MOBILE
        ================================= */

        @media (max-width: 650px) {

            .navbar {
                gap: 3px;

                padding: 11px 5px;
            }

            .navbar::before,
            .navbar::after {
                display: none;
            }

            .navbar a {
                padding: 9px 11px;

                font-size: 11px;
            }

            .profile {
                width: calc(100% - 20px);

                margin-top: 35px;
            }

            .header-card {
                padding: 38px 18px;
            }

            .profile-label {
                font-size: 8px;
            }

            .avatar {
                width: 100px;
                height: 100px;

                font-size: 19px;
            }

            h1 {
                font-size: 23px;
            }

            .subtitle {
                font-size: 12px;

                line-height: 1.6;
            }

            .card {
                padding: 20px 16px;

                border-radius: 17px;
            }

            .card h2 {
                font-size: 14px;
            }

            .info {
                grid-template-columns: 1fr;

                gap: 5px;

                padding: 14px 5px;
            }

            .value {
                font-size: 13px;
            }

            .social-links {
                flex-direction: column;
            }

            .social-links a {
                width: 100%;
            }

            .back-button {
                width: 100%;

                text-align: center;
            }
        }


        /* =================================
           SMALL PHONES
        ================================= */

        @media (max-width: 400px) {

            .profile {
                width: calc(100% - 16px);
            }

            .header-card {
                padding: 32px 15px;
            }

            h1 {
                font-size: 20px;
            }

            .subtitle {
                font-size: 11px;
            }

            .card {
                padding: 17px 13px;
            }

            .card h2 {
                font-size: 12px;
            }

            .navbar a {
                font-size: 9px;
            }
        }
    </style>
</head>

<body>

<?php
$student_id = isset($student_id) ? $student_id : '';
$name = isset($name) ? $name : '';
$course = isset($course) ? $course : '';
$year = isset($year) ? $year : '';
$section = isset($section) ? $section : '';
$email = isset($email) ? $email : '';
$contact = isset($contact) ? $contact : '';
$address = isset($address) ? $address : '';
$skills = isset($skills) ? $skills : '';
$hobbies = isset($hobbies) ? $hobbies : '';
$description = isset($description) ? $description : '';
$facebook = isset($facebook) ? $facebook : '';
$instagram = isset($instagram) ? $instagram : '';
$github = isset($github) ? $github : '';
?>


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
     PROFILE
================================= -->

<div class="profile">


    <!-- =================================
         PROFILE HEADER
    ================================= -->

    <div class="header-card">

        <div class="profile-label">
            🌻 Student Profile
        </div>


        <h1>
            <?= $name ? $name : "Student Profile" ?>
        </h1>

        <p class="subtitle">
            Bachelor of Science in Information Technology Student
        </p>

    </div>


    <!-- =================================
         PERSONAL INFORMATION
    ================================= -->

    <div class="card">

        <h2>
            Personal Information
        </h2>

        <div class="info">
            <span class="label">
                Student ID
            </span>

            <span class="value">
                <?= $student_id ?>
            </span>
        </div>

        <div class="info">
            <span class="label">
                Student Name
            </span>

            <span class="value">
                <?= $name ?>
            </span>
        </div>

        <div class="info">
            <span class="label">
                Course
            </span>

            <span class="value">
                <?= $course ?>
            </span>
        </div>

        <div class="info">
            <span class="label">
                Year Level
            </span>

            <span class="value">
                <?= $year ?>
            </span>
        </div>

        <div class="info">
            <span class="label">
                Section
            </span>

            <span class="value">
                <?= $section ?>
            </span>
        </div>

        <div class="info">
            <span class="label">
                Email
            </span>

            <span class="value">
                <?= $email ?>
            </span>
        </div>

        <div class="info">
            <span class="label">
                Contact Number
            </span>

            <span class="value">
                <?= $contact ?>
            </span>
        </div>

        <div class="info">
            <span class="label">
                Address
            </span>

            <span class="value">
                <?= $address ?>
            </span>
        </div>

    </div>


    <!-- =================================
         ABOUT ME
    ================================= -->

    <div class="card">

        <h2>
            About Me
        </h2>

        <p class="about">
            <?= $description ?>
        </p>

        <div class="info">

            <span class="label">
                Skills
            </span>

            <span class="value">
                <span class="tag-value">
                    <?= $skills ?>
                </span>
            </span>

        </div>

        <div class="info">

            <span class="label">
                Hobbies
            </span>

            <span class="value">
                <span class="tag-value">
                    <?= $hobbies ?>
                </span>
            </span>

        </div>

    </div>


    <!-- =================================
         SOCIAL MEDIA
    ================================= -->

    <div class="card">
        

        <h2>
            Social Media
        </h2>

        <div class="social-links">

            <?php if (!empty($facebook)) : ?>
                <a href="<?= $facebook ?>" target="_blank">
                    Facebook
                </a>
            <?php endif; ?>

            <?php if (!empty($instagram)) : ?>
                <a href="<?= $instagram ?>" target="_blank">
                    Instagram
                </a>
            <?php endif; ?>

            <?php if (!empty($github)) : ?>
                <a href="<?= $github ?>" target="_blank">
                    GitHub
                </a>
            <?php endif; ?>

        </div>

    </div>


    <!-- =================================
         BACK BUTTON
    ================================= -->

    <a
        class="back-button"
        href="<?= site_url('student'); ?>"
    >
        Back to Student Info
    </a>


    <!-- =================================
         FOOTER
    ================================= -->

    <div class="footer">

        <div class="footer-decoration">
            🌻 ✦ 🌻 ✦ 🌻
        </div>

        Student Profile using LavaLust
        <br>

        By Riesbelle Villamor
    </div>

</div>

</body>
</html>
