
<?php 
require (__DIR__. "/../componentes/header.php");

?>

<main class="main-content col-md-10 px-md-5">
    
    <div class="row p-4">  
        <h1 class="m-4 mt-6">Plano de Estudos Personalizado:</h1>
        <?php
          $studyPlans = $dados['studyPlans'];
          foreach($studyPlans as $studyPlan):
        ?>
          <div class="row">
              <div class="col-md-9">
                  <hr><h5><?= $studyPlan->getMarker() ?></h5><hr>
               </div>
               <?php
                   foreach($studyPlan->getSuggestedModules() as $suggestedModule):
                    $module = $suggestedModule->getModule();
               ?> 
               <div class="accordion" id="accordionMain">
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $module->getId() ?>" aria-expanded="true" aria-controls="collapse<?= $module->getId() ?>">
                            <h4><?= $module->getName() ?></h4>
                        </button>
                      </h2>
                      <div id="collapse<?= $module->getId() ?>" class="accordion-collapse collapse show" data-bs-parent="#accordionMain">
                        <div class="accordion-body">
                            <?php foreach($module->getLessons() as $lesson):?>
                                  <div class="lesson col-md-4 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                  <iframe id="<?php echo $lesson->getId(); ?>" src="<?php echo $lesson->getUrl(); ?>"></iframe>
                                                  <div class="lesson-title">
                                                  <label for="lesson-<?php echo $lesson->getId(); ?>"><?php echo $lesson->getTitle(); ?></label>
                                           </div>
                                        </div>
                                    </div>
                              <?php endforeach; ?>
                        </div>
                    </div>
                </div>
               <?php endforeach; ?>
          </div>
          <?php endforeach; ?>
    </div>
</main>