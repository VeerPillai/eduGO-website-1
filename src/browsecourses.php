<?php
    require "header.php"
?>

<?php
        require "navbar.php"
?>


<div class="row" id="course-heading">
    <div class="col-lg-12 col-sm-12">
        <div class="inbody">
            <div class="container-browse-courses">
                <div class="jumbotron jumbotron-fluid">
                    <div class="contrainer">
                        <h1 class="display-4">Learn 
                            <!--this span will then be called in javascript and values will be taken -->
                            <span class="txt-type" data-wait="1000" data-words = '["JavaScript" , "Data Structures" , "Java", "Python", "Computer Graphics", "DBMS"]'></span>
                            <br>
                        </h1>
                        <p class="lead">Engineering Concepts on the GO!!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="course-main-section" style="padding-bottom: 50px;">
    <div class="container-fluid">
        <div class="row">
            <div class="course-about-heading"> 
                <h1>Courses</h1>
            </div>
        </div>
        <?php
            require 'includes/dbh.inc.php';
            $result = mysqli_query($conn, "SELECT * FROM courses");
            $countRows = mysqli_num_rows($result);
            if($countRows > 0)
            {
                $cols = 4;    // Define number of columns
                $counter = 1;     // Counter used to identify if we need to start or end a row
                $nbsp = $cols - ($countRows % $cols);    // Calculate the number of blank columns
                
                $row_class = 'row';    // Row class name
                $col_class = 'col-lg-3'; // Column class name


                while ($item = mysqli_fetch_array($result))
                {
                    if(($counter % $cols) == 1) // Check if it's new row
                    {    
                        echo '<div style="padding-top: 50px;" class="'.$row_class.'">';	// Start a new row
                    }
                    echo '
                        <div class="browse-course-div col-sm-12 '.$col_class.'">
                            <div class="card center h-100 browse-course-card">
                            <img height="200px" class="card-img-top" src="images/uploads/'. $item['thumbnail'] .'" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">'. $item['course_name'] .'</h5>
                                                <h6 class="card-subtitle mb-2 text-muted">'. $item['dsc'] .'</h6>
                                                <a class="learnmore" href="coursedetails.php?courseId='  .$item['course_id'].  '" class="card-link">Learn More</a>
                                </div>
                            </div>
                        </div>

                    ';
                    if(($counter % $cols) == 0)
                    { // If it's last column in each row then counter remainder will be zero
                        echo '</div>';	 //  Close the row
                    }
                    $counter++;    // Increase the counter
                    
                }
                if($nbsp > 0)
                { // Adjustment to add unused column in last row if they exist
                    for ($i = 0; $i < $nbsp; $i++)
                    { 
                        echo '<div class="'.$col_class.'">&nbsp;</div>';		
                    }
                    echo '</div>';  // Close the row
                }
            }
        
            echo '
    </div>
</div>';
?>


<?php
    require "footer.php"
?>