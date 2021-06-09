<?php

include('action/connection.php');


if (isset($_POST["loginBtn"])) {

    $search = $_POST["search"];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>stocks</title>
    <style>
        body {
            background-color: #d2f7ed;
            color: black;
        }

        .search-button {
            background-color: white;
            border: none;
            border-radius: 5px 0px 0px 5px;
        }

        .search-area {
            border-radius: 0px 5px 5px 0px;
            border-style: none;

        }

        .result {
            border-radius: 15px;
        }

        .search-dropedown {

            background-color: #c7d9d4;
            margin-left: 26px;
            width: 450px;
            border-radius: 0px 0px 8px 8px;
        }

        tr:nth-child(even) {
            background-color: #0bfe1724;
        }
    </style>
</head>

<body>

    <header style="background-color:#c7d9d4;">
        <div class="row">
            <div class="col">
                <div class="container">
                    <!-- As a link -->
                    <nav class="navbar navbar-light">
                        <div class="container-fluid">
                            <a class="navbar-brand fw-bold" href="#">Stocks</a>
                        </div>
                    </nav>

                </div>
            </div>
        </div>
    </header>
    <main>
        <section>
            <div class="row">
                <dic class="col">
                    <div class="container">
                        <div class="text-center mt-5">
                            <h1 class="d-block">The easiest way to buy</h1>
                            <h1 class="d-block">and sell stocks</h1>
                            <div class="mt-3 fs-5">
                                <span class="d-block ">stock analysis and screening tool for</span>
                                <span class="d-block">investors of india</span>
                            </div>
                        </div>
                    </div>
                </dic>
            </div>
            <div class="row">
                <div class="col">
                    <div class="container">

                        <!--*********** form ******* -->
                        <form action="" method="post" id="loginform">

                            <div class="d-flex justify-content-center mt-3">

                                <button type="submit" name="loginBtn" class="search-button"><i class="fas fa-search" id="loginBtn"></i></button>
                                <input type="text" class="form-control search-area" placeholder=" search" style="width: 450px;" name="search">
                            </div>
                        </form>
                        <!-- *****drop down******** -->
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center ">
                                <div class="search-dropedown">
                                    <ul style="list-style: none;">

                                    </ul>
                                </div>

                            </div>
                            <div></div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="search-result">
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/3c63ad2e8e.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>



    <script type="text/javascript">
        $(document).ready(function() {
            $('.search-dropedown').hide();
            $('.search-result').hide();

            $('#loginform').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'search.php',
                    data: $(this).serialize(),
                    success: function(response) {
                        var jsonData = JSON.parse(response);
                        var output_html = '';
                        $('.search-result').html('');
                        if (jsonData.length != 0) {
                            $.each(jsonData, function(index, value) {
                                output_html += '<div style="background-color: white;" class="result mt-4 p-4"> <h3 class="head-el"> ' + value['name'] + '</h3><div class="d-flex justify-content-center "><table class="table table-borderless"><thead></thead><tbody class="table-tbody-el">';
                                output_html += '<tr><td>Market cap <span class="text-danger" style="margin-left: 18px;"> <i class="fas fa-rupee-sign"></i> ' + value['market_cap'] + ' </span> </td>';
                                output_html += '<td>Divident yield <span class="text-danger" style="margin-left: 18px;">' + value['dividend_yield'] + '<i class="fas fa-percentage"></i></span></td>';
                                output_html += '<td>Debt equity <span class="text-danger" style="margin-left: 18px;">' + value['debit_to_equity'] + '<i class="fas fa-percentage"></i></span> </td></tr>';
                                output_html += '<tr><td> Current price <span class="text-danger" style="margin-left: 18px;"> <i class="fas fa-rupee-sign"></i>' + value['current_market_price'] + '</span></td>';
                                output_html += '<td> ROCE <span class="text-danger" style="margin-left: 18px;">' + value['roce_percentage'] + '<i class="fas fa-percentage"></i></span> </td>';
                                output_html += '<td> ROCE <span class="text-danger" style="margin-left: 18px;">' + value['roce_percentage'] + '<i class="fas fa-percentage"></i></span> </td>';
                                output_html += '<tr><td> stock Price <span class="text-danger" style="margin-left: 18px;"> <i class="fas fa-rupee-sign"></i>' + value['stocke_pe'] + '</span> </td>';
                                output_html += '<td> ROE <span class="text-danger" style="margin-left: 18px;"> <i class="fas fa-rupee-sign"></i>' + value['roce_percentage'] + '</span> </td>';
                                output_html += '<td> EPS <span class="text-danger" style="margin-left: 18px;"> <i class="fas fa-rupee-sign"></i>' + value['eps'] + '</span> </td> </tr>';
                                output_html += '<tr><td>Debt  <span class="text-danger" style="margin-left: 18px;"> <i class="fas fa-rupee-sign"></i> ' + value['debt'] + ' </span> </td></tr>';
                                output_html += '</tbody></table></div></div>';

                            });
                           
                            $('.search-result').append(output_html);
                            $('.search-result').show();
                        } else {
                            $('.search-result').hide();
                        }

                    }
                });
            });

            $('.search-area').on('change', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'search.php',
                    data: {
                        search: $(this).val()
                    },
                    success: function(response) {
                        $('.search-result').html('');
                        var jsonData = JSON.parse(response);
                        var suggestion_html = '';

                        $.each(jsonData, function(index, value) {
                            suggestion_html += '<li>' + value['name'] + '</li>';

                        });
                        $('.search-dropedown ul').html(suggestion_html);
                    
                    }
                });
            });

            $('.search-area').on('keyup', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'search.php',
                    data: {
                        search: $(this).val()
                    },
                    success: function(response) {
                        $(".search-dropedown").find("ul").empty();
                        var jsonData = JSON.parse(response);
                        var suggestion_html = '';

                        $.each(jsonData, function(index, value) {
                            suggestion_html += '<li>' + value['name'] + '</li>';

                        });

                        $('.search-dropedown ul').html(suggestion_html);
                        $('.search-dropedown').show();

                    }
                });
            });
            $(document).on('click', '.search-dropedown ul li', function() {
                $('.search-area').val($(this).text());
            })
        });
    </script>
</body>

</html>