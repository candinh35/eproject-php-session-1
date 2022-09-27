<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <?php
            for ($i = 0; $i < 3; $i++) {
            ?>
                <div class="col">
                    <?php
                    for ($k = 0; $k < 6; $k++) {
                    ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" <?php if (($i == 0 && $k >= 3) || ($i == 1 && $k % 2 != 0) || ($i == 2 && ($k == 0 || $k == 4))) {
                                                                                            echo 'checked="checked"';
                                                                                        } ?> id="flexCheckDefault<?php echo $k; ?>">
                            <label class="form-check-label" for="flexCheckDefault<?php echo $k; ?>">
                                Checkbox <?php echo $k + 1; ?>
                            </label>
                        </div>
                    <?php
                    }
                    ?>
                </div>

            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>