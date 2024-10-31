<?php
 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <section class="container">
        <h2>Add new record</h2>
        <div>
            <form action="index.php" method="POST">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">First name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="firstname"
                        placeholder="First name">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Last name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput2" name="lastname"
                        placeholder="Last name">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Age</label>
                    <input type="number" class="form-control" id="exampleFormControlInput3" name="age"
                        placeholder="Age">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Birth date</label>
                    <input type="text" class="form-control" id="exampleFormControlInput4" name="birth_date"
                        placeholder="2000-01-01">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Add new record</button>
            </form>
        </div>

    </section>

</body>

</html>