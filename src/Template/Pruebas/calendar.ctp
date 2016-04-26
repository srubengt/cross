

<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php //$title_layout?>
            <small><?php //$small_text;?></small>
          </h1>
          <ol class="breadcrumb">
              
            <?php
                $this->Html->addCrumb('Home', [
                    'url' => ['controller' => 'Pages', 'action' => 'display', 'home'],
                    'escape' => false
                    ]);
                $this->Html->addCrumb('Pages', ['controller' => 'pages']); 
                $this->Html->addCrumb('About', ['controller' => 'pages', 'action' => 'about']);
                echo $this->Html->getCrumbList();
            ?>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- //////////////////////////////////////////////////////////////////////-->

            <nav class="large-3 medium-4 columns" id="actions-sidebar">
             
            </nav>
            <div class="users index large-9 medium-8 columns content">
                <div class="box box-primary">
                  <div class="box-body no-padding">
                    <!-- THE CALENDAR -->
                    <div id="calendar"></div>
                  </div>
                  <!-- /.box-body -->
                </div>
            </div>
            
            <!-- //////////////////////////////////////////////////////////////////////-->
        </section><!-- /.content -->