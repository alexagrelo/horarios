<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <title>Schedule</title>
</head>

<body>

    <?php
    $FILE = 'horarios.json';
    $data = array();

    session_start();

    if ($SESSION['alert_text'] != '') {
        echo '<div class="alert alert-danger" role="alert">' . $SESSION['alert_text'] . '</div>';
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_POST['fromForm'] == 'yes') {
            if ($_POST['inputSubject'] != '' && $_POST['inputTeacher'] != '' && $_POST['inputWeeklyHours'] != null) {
                $SESSION['alert_text'] = '';
                $subject = utf8_encode($_POST['inputSubject']);
                $teacher = utf8_encode($_POST['inputTeacher']);
                $weeklyHours = utf8_encode($_POST['inputWeeklyHours']);
                $data[] = array('subject' => $subject, 'teacher' => $teacher, 'weeklyHours' => $weeklyHours); //Añado el nuevo registro al array
                $json = json_encode($data); //Convierto el array en JSON
                file_put_contents($FILE, $json); //Escribo el JSON en el archivo
            }

            if ($_POST['inputSubject'] == '') {
                $SESSION['alert_text'] = 'Please, enter a subject';
            }

            if ($_POST['inputTeacher'] == '') {
                $SESSION['alert_text'] = 'Please, enter a teacher';
            }

            if ($_POST['inputWeeklyHours'] == null) {
                $SESSION['alert_text'] = 'Please, enter the weekly hours';
            }
        }
    }
    ?>

    <!-- <h1>The form method="post" attribute</h1>

    <form method="post">
        <input type="hidden" name="fromForm" value="yes" />
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject"><br><br>
        <label for="teacher">Teacher:</label>
        <input type="text" id="teacher" name="teacher"><br><br>
        <label for="weekly_hours">Weekly Hours:</label>
        <input type="number" id="weekly_hours" name="weekly_hours"><br><br>
        <input type="submit" value="Submit">
    </form> -->

    <div class="row mt-3 mx-3">
        <!-- FORMULARIO BÁSICO -->
        <div class="col-lg-4 col-12">
            <h1 class="my-2">School Schedule Form</h1>
            <form id="schoolScheduleForm" method="post">
                <input type="hidden" name="fromForm" value="yes" /> <!-- Campo oculto -->
                <div class="mb-3">
                    <label for="inputSubject" class="form-label text-primary">
                        Subject
                    </label>
                    <select class="form-select" aria-label="Subject selection" id="inputSubject">
                        <option selected value="Lengua">Lengua</option>
                        <option value="Mates">Mates</option>
                        <option value="Religión">Religión</option>
                        <option value="Inglés">Inglés</option>
                        <option value="EF">EF</option>
                        <option value="Informática">Informática</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="inputTeacher" class="form-label text-primary">
                        Teacher
                    </label>
                    <select class="form-select" aria-label="Teacher selection" id="inputTeacher" required>
                        <option selected value="AlexCeo">AlexCeo</option>
                        <option value="AlexWizard">AlexWizard</option>
                        <option value="David">David</option>
                        <option value="Debo">Debo</option>
                        <option value="Helena">Helena</option>
                        <option value="Bruno">Bruno</option>
                    </select>
                </div>
                <div class="mb-3 col-6 col-md-4">
                    <label for="inputWeeklyHours" class="form-label text-primary">
                        Weekly hours
                    </label>
                    <input type="number" class="form-control" id="inputWeeklyHours" aria-describedby="weeklyHoursInput" min="1" max="10" value="1" />
                </div>
                <button type="submit" class="btn btn-success" id="btnSubmit">Submit</button>
            </form>
        </div>
        <div class="col-lg-8 col-12">
            <!-- TABLA DE RESULTADOS -->
            <table class="table table-hover mt-3" id="dataTable">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Teacher</th>
                        <th>Weekly Hours</th>
                    </tr>
                </thead>
                <tbody> </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="index.js"></script>
    <script>
        data = JSON.parse('<?php echo $json; ?>');
    </script>
</body>

</html>