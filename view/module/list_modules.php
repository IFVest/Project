<?php 
require (__DIR__. "/../componentes/header.php");
require_once(__DIR__ . "/../../model/Subjects.php");
require_once(__DIR__ . "/../../util/config.php");
?>

    <!-- MAIN CONTENT-->
    
    <main class="main-content col-md-10 px-md-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            
            <h1 class="content-title">Listagem de modulos</h1>

        </div>

        <h5 class="content-subtitle"></h5>


        <div class="subjects">
        <div class="subjects-header">
        </div>
        <div class="subjects-body">
        <div class="row">

            <?php foreach (Subjects::cases() as $subject) : ?>
                <div class="col-md-12">
                    <div class="subject card module ps-3 pt-3 pb-3 mb-4" aria-expanded="false" onclick="showListModules('<?php echo $subject->name; ?>')">
                        <?php echo $subject->name; ?> 
                    </div>

                </div>
                <div id='listagem-<?php echo $subject->name; ?>' class="list-modules col-md-12">
                    <div class="modules" id="<?php echo $subject->name; ?>"></div>
                </div>

            <?php endforeach; ?>

            </div>
        </div>
        
    </div>

    <script src="<?= BASE_URL ?>/js/listFiltering.js" type="module"></script>

    </main>

    <?php require __DIR__. "/../componentes/footer.php"?>   
    
    
    <script>
        var listModules = document.querySelectorAll('.list-modules');
        
        listModules.forEach(list => {
            list.style.display = 'none';
        });

        function showListModules(nameList){

            var listModules = document.querySelectorAll('.list-modules');


            listModules.forEach(list => {
                list.style.display = 'none';
            });

            var id = 'listagem-'+nameList;
            console.log(id);
            var list = document.getElementById(id);
            list.style.display = 'block';
        }

    </script>