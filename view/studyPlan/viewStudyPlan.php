
<?php 
require (__DIR__. "/../componentes/header.php");

?>

<main class="main-content col-md-10 px-md-5">
    
    <div class="row p-4">  
        <h1 class="m-1 my-4" style="color: #58b352">Plano de Estudos Personalizado</h1>
        <?php
          $studyPlans = $dados['studyPlans'];
          foreach($studyPlans as $studyPlan):
        ?>
          <div class="row">
              <div class="col-md-9">
                  <hr><h4><?= $studyPlan->getMarker() ?></h4><hr>
               </div>
               <?php
                   foreach($studyPlan->getSuggestedModules() as $suggestedModule):
                    $module = $suggestedModule->getModule();
               ?> 
               <div class="accordion" id="accordionMain">
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $module->getId() ?>" aria-expanded="false" aria-controls="collapse<?= $module->getId() ?>">
                            <h4 style="font-size: 18px;"><?= $module->getName() ?></h4>
                        </button>
                      </h2>
                      <div id="collapse<?= $module->getId() ?>" class="accordion-collapse collapse" data-bs-parent="#accordionMain">
                        <div class="accordion-body d-flex flex-wrap">
                          <?php 
                            if($module->getLessons()){
                              foreach($module->getLessons() as $lesson):?>
                                <div class="lesson mx-2" style="width: 330px;">
                                      <a class="card" style="text-decoration: none; cursor: pointer;" href='<?= BASE_URL?>/controller/LessonController.php?action=showModuleLessons&moduleId=<?= $module->getId()?>&moduleName=<?= $module->getName()?>'>
                                        <div class="card-body" style="cursor: pointer;">
                                          <iframe class='<?= BASE_URL?> <?= $module->getId()?> <?= $module->getName()?>' id="<?= $lesson->getId() ?>" src="<?= $lesson->getUrl() ?>" height="200px" width="auto"></iframe>
                                          <div class="lesson-title">
                                            <label for="lesson-<?= $lesson->getId() ?>"> <?= $lesson->getTitle() ?> </label>
                                          </div>
                                        </div>
                                      </a>
                                  </div>
                                <?php endforeach; ?>
                          <?php
                            }else{
                              echo '<h6>Sem Aulas</h6>';
                            } 
                          ?>
                        </div>
                    </div>
                </div>
               <?php endforeach; ?>
          </div>
          <?php endforeach; ?>
    </div>
</main>
<input type="hidden" name='base_url' class='base_url' value='<?= BASE_URL?>'>

<script src="<?= BASE_URL?>/view/studyPlan/script.js"></script>