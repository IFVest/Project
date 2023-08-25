<?php
    error_reporting(E_ERROR);
    include(__DIR__ . "/../componentes/header.php");
    require_once(__DIR__ . "/../../util/config.php");
    require_once(__DIR__ . "/../../model/Subjects.php");
?> 


<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Simulado</title>
</head>

<body>
    <main class="main-content col-md-10 px-md-5">
        <div class="component p-5 d-flex flex-column align-items-center justify-content-center">
            <h1 class='my-2'>Criar Simulado Personalizado</h1>
            <div class="form card col-10 m-3 p-3">
                <form method="POST" action="<?= BASE_URL ?>/controller/ExamController.php?action=save" class='d-flex flex-column col-8'>
                    <div class="type-exam d-flex justify-content-between">
                        <div class="personalized m-2">
                            <label for="personalized">Personalizado</label>
                            <input type="radio" name="exam_type" class="exam_type" id="personalized" value="personalized">
                        </div>
                        <div class="default m-2">
                            <label for="personalized">Padrão IFPR</label>
                            <input type="radio" name="exam_type" class="exam_type" id="default" value="default">
                        </div>
                    </div>
                    
                    <div class="filters col-6" style="display: none; border: 1px solid black; flex-direction: column">
                        <div class="params col-11">
                            <label for='subjects'>Matéria:</label>
                            <select class='subjects' name="subject1" id='subjects'>
                                <?php foreach (Subjects::cases() as $subject) : ?>
                                    <option class="subject" value="<?php echo $subject->name; ?>"><?php echo $subject->name ?></option>
                                <?php endforeach; ?>
                            </select>
                            <br>
                            <label for='modules'>Módulos:</label>
                            <div class="modules" id="modules" name='modules'>

                            </div>
                        </div>


                        <button type="button" class='new-filter-button'>Adicionar componente</button>
                    </div>
                    
        
                    <button type="submit" class='btn btn-primary'>Criar</button>
                    <input type='hidden' value='0' name='filters_count'>
                    <input type='hidden' value='<?= $_SESSION['userId'];?>' name='user_id'>
                </form>
                <div class="error-div">
                    <?php require_once(__DIR__ . "/../include/msg.php");?>
                </div>
            </div>
        </div>
    </main>
    <script>
        let filterDiv = document.querySelector('.filters')
        let inputType = document.querySelector('.exam_type')
        let newFilter = document.querySelector('.new-filter-button')
        let selectCounter = 1

        inputType.addEventListener('change', (event)=>{
            filterDiv.style.display = (event.target.value == 'personalized')? 'flex' : 'none'
        })

        newFilter.addEventListener('click', ()=>{
            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", "SubjectsController.php?action=findAll", true);
            xhttp.onload = function (){
                if (xhttp.status >= 200 && xhttp.status < 400) {
                    let subjects = JSON.parse(this.responseText);

                    let select = createElement('select')
                    select.setAttribute('class', 'subjects')
                    select.setAttribute('name', 'subject')
                }
            };
            xhttp.send();
        })

    </script>
    <script src="<?= BASE_URL ?>/js/examFilterByModule.js" type="module"></script>
</body>

</html>