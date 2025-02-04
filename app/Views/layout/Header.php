<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cat Cafe's</title>
    <link rel="icon" type="image/png" href="<?= base_url('img/tabicon.png'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
          @import url('https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&family=Noto+Serif+JP:wght@200..900&display=swap');
body {
    display: flex;
    background: #d4ccb6;
    font-family: Arial, sans-serif;
}
.Ims{
    font-family: 'Karla', sans-serif;
    color: black;
    font-weight: bold;
    font-size: 16px;
   
}
.sideLine{
    background: #A59D84;
    width: 5px;
    height: 20px;
    font-size: 20px;
    border-radius: 10px;
}
.sidebar {
    width: 200px;
    height: 100vh;
    position: fixed;
    background: #D7D3BF;
    padding: 20px;
    color: white;
    border-right: 1px solid rgb(162, 160, 150);
    box-shadow: #5A4E3C -3px 2px 15px 0px;
}
h6 {
    font-size: 1rem;
    color: #D4A373;
    font-weight: bold;
}
.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    padding: 10px;
    cursor: pointer;
}
.sidebar ul li a.active {
    background-color: #d4ccb6;
    height: 5px;
    padding: 10px;
    border-radius: 10px;
    color: white;
    font-weight: bold;
}

a{
    text-decoration: none;
    color: white;
    font-size: 16px;
}
.form-control{
    border-radius: 10px;
    background: transparent;
}
.main-content {
    flex: 1;
    padding: 20px 40px 20px 240px;
}
.dropdown-item{
    position: relative;
    z-index: 9999;
}
.dropdown-toggle::after {
    display: none; 
}
.navbar {
    display: flex;
    justify-content: space-between;
    position: sticky;
    align-items: center;
    background: #A59D84;
    padding: 10px;
    border-radius: 10px;
    box-shadow: #5A4E3C -3px 2px 15px 0px;
}

.search-bar {
    border: 1px solid #ccc;
    padding: 5px;
    border-radius: 5px;
}

/* Hide sidebar on small screens */
@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
        width: 200px;
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
    }

    .sidebar.show {
        transform: translateX(0);
    }
    .main-content {
    flex: 1;
    width: 100%;
    padding: 5px;
    transition: margin-left 0.3s ease-in-out;
    }
}
@media (max-width: 600px) {
    .sidebar {
        transform: translateX(-100%);
        width: 200px;
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
    }

    .sidebar.show {
        transform: translateX(0);
    }
    .main-content {
    flex: 1;
    width: 100%;
    padding: 5px;
    transition: margin-left 0.3s ease-in-out;
    }
canvas#lineChart {
    background: #ECEBDE;
    height: 100% !important;
    width: 100% !important;
    border-radius: 25px;
    border: none;
}
canvas#polarChart {
    background: #ECEBDE;
    height: 100%;
    width: 100%;
    border-radius: 25px;
}
.Linechart  {
    background: #ECEBDE;
    display: contents;
    width: 300px !important;
    height: 350px !important;
    border-radius: 25px;
}
.RadarC {
    background: #ECEBDE;
    width: 300px !important;
    height: 300px;
    border-radius: 25px;
}
}

a{
    text-decoration: none;
    color: white;
    font-size: 16px;
}
.form-control{
    border-radius: 10px;
    background: transparent;
}

.dropdown-item{
    position: relative;
    z-index: 9999;
}
.dropdown-toggle::after {
    display: none; 
}
.table-responsive {
    overflow-x: auto;
    white-space: nowrap; /* Prevent text from wrapping */
  }
.user-profile img {
    border-radius: 50%;
}
.chart-container{
    gap: 70px;
}
.Linechart  {
    background: #ECEBDE;
    width: 60%;
    border-radius: 25px;
    box-shadow: #5A4E3C -3px 2px 15px 0px;
}
.LinechartS{
    background: #ECEBDE;
    width: 100%;
    border-radius: 25px;
}
.RadarC {
    background: #ECEBDE;
    width: 30%;
    border-radius: 25px;
    box-shadow: #5A4E3C -3px 2px 15px 0px;
}
.RadarCS {
    background: #ECEBDE;
    width: 100%;
    border-radius: 25px;
}
.card {
    z-index: -1;
    background: #f2ede0;
    padding: 10px;
    border-radius: 10px;
    text-align: center;
    box-shadow: #5A4E3C -3px 2px 15px 0px;
}

.table {
    background: white;
}
.active {
    font-weight: bold;
    color: #007bff;
    text-decoration: none;
}
.badge {
            text-transform: capitalize;
        }

        .modal-content {
            background: #f9f9f9;
        }

        .modal-title {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #A59D84;
            border-color: #A59D84;
        }

        .btn-primary:hover {
            background-color: #8e846c;
            border-color: #8e846c;
        }

    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<div class="g-recaptcha" data-sitekey="6LesE8wqAAAAAFGQb8owvb9VoWoM7tSeaFbcv296"></div>