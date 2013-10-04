<?php $this->pageTitle=Yii::app()->name; ?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
 
 
 
 <h3><a href="" onclick="alert('not functional yet');">Startups Statistics</a></h3>
 <h3><a href=""  onclick="alert('not functional yet');">Ideas Statistics</a></h3>
 <h3><a href=""  onclick="alert('not functional yet');">Growth Statistics</a> </h3>
 
 
 <i>mail functionalities are not enabled yet on this demo server</i>
 
 <hr>
 
 <h3>Available types of charts </h3>
 <h4>Demo no realistic Data </h4>
 
 <h5>Bar</h5>
     <?php 
        $this->widget(
            'chartjs.widgets.ChBars', 
            array(
                'width' => 600,
                'height' => 300,
                'htmlOptions' => array(),
                'labels' => array("January","February","March","April","May","June"),
                'datasets' => array(
                    array(
                        "fillColor" => "#ff00ff",
                        "strokeColor" => "rgba(220,220,220,1)",
                        "data" => array(10, 20, 30, 40, 50, 60)
                    )       
                ),
                'options' => array()
            )
        ); 
    ?>
    
 <h5>line</h5>
       <?php 
        $this->widget(
            'chartjs.widgets.ChLine', 
            array(
                'width' => 600,
                'height' => 300,
                'htmlOptions' => array(),
                'labels' => array("January","February","March","April","May","June"),
                'datasets' => array(
                    array(
                        "fillColor" => "rgba(220,220,220,0.5)",
                        "strokeColor" => "rgba(220,220,220,1)",
                        "pointColor" => "rgba(220,220,220,1)",
                        "pointStrokeColor" => "#ffffff",
                        "data" => array(10, 20, 25, 25, 50, 60)
                    ),
                    array(
                        "fillColor" => "rgba(220,220,220,0.5)",
                        "strokeColor" => "rgba(220,220,220,1)",
                        "pointColor" => "rgba(220,220,220,1)",
                        "pointStrokeColor" => "#ffffff",
                        "data" => array(55, 50, 45, 30, 20, 10)
                    )      
                ),
                'options' => array()
            )
        ); 
    ?>
    
    
 <h5>Pie</h5>
 <?php 
            $this->widget(
                'chartjs.widgets.ChPie', 
                array(
                    'width' => 600,
                    'height' => 300,
                    'htmlOptions' => array(),
                    'drawLabels' => true,
                    'datasets' => array(
                        array(
                            "value" => 50,
                            "color" => "rgba(220,30, 70,1)",
                            "label" => "Hunde"
                        ),
                        array(
                            "value" => 25,
                            "color" => "rgba(66,66,66,1)",
                            "label" => "Katzen"
                        ),
                        array(
                            "value" => 40,
                            "color" => "rgba(100,100,220,1)",
                            "label" => "Vögel"
                        ),
                        array(
                            "value" => 15,
                            "color" => "rgba(20,120,120,1)",
                            "label" => "Mäuse"
                        )
                    ),
                    'options' => array()
                )
            ); 
        ?>
        
          <?php 
          /*
        $this->widget(
            'chartjs.widgets.ChDoughnut', 
            array(
                'width' => 600,
                'height' => 300,
                'htmlOptions' => array(),
                'drawLabels' => true,
                'datasets' => array(
                    array(
                        "value" => 50,
                        "color" => "rgba(220,30, 70,1)",
                        "label" => "Hunde"
                    ),
                    array(
                        "value" => 25,
                        "color" => "rgba(66,66,66,1)",
                        "label" => "Katzen"
                    ),
                    array(
                        "value" => 40,
                        "color" => "rgba(100,100,220,1)",
                        "label" => "Vögel"
                    ),
                    array(
                        "value" => 15,
                        "color" => "rgba(20,120,120,1)",
                        "label" => "Mäuse"
                    )
                ),
                'options' => array()
            )
        ); 
    ?>
    
    
        <?php 
        $this->widget(
            'chartjs.widgets.ChPolar', 
            array(
                'width' => 600,
                'height' => 300,
                'htmlOptions' => array(),
                'drawLabels' => true,
                'datasets' => array(
                    array(
                        "value" => 50,
                        "color" => "rgba(220,30, 70,1)",
                        "label" => "Hunde"
                    ),
                    array(
                        "value" => 25,
                        "color" => "rgba(66,66,66,1)",
                        "label" => "Katzen"
                    ),
                    array(
                        "value" => 40,
                        "color" => "rgba(100,100,220,1)",
                        "label" => "Vögel"
                    ),
                    array(
                        "value" => 15,
                        "color" => "rgba(20,120,120,1)",
                        "label" => "Mäuse"
                    )
                ),
                'options' => array()
            )
        ); 
    ?>
    
       <?php 
        $this->widget(
            'chartjs.widgets.ChRadar', 
            array(
                'width' => 600,
                'height' => 300,
                'htmlOptions' => array(),
                'labels' => array("January","February","March","April", "May"),
                'datasets' => array(
                    array(
                        "fillColor" => "rgba(220,220,220,0.5)",
                        "strokeColor" => "rgba(220,220,220,1)",
                        "pointColor" => "rgba(220,220,220,1)",
                        "pointStrokeColor" => "#ffffff",
                        "data" => array(5, 15, 50, 25, 35)
                    ),
                    array(
                        "fillColor" => "rgba(220,220,220,0.5)",
                        "strokeColor" => "rgba(220,220,220,1)",
                        "pointColor" => "rgba(220,220,220,1)",
                        "pointStrokeColor" => "#ffffff",
                        "data" => array(55, 50, 45, 30, 20)
                    )      
                ),
                'options' => array()
            )
        ); 
*/
    ?>