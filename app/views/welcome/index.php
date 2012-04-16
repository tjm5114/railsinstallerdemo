<?php
	require_once('dbconnector.php');
	require_once('functions.php');
	
	$studentsID = $_SESSION['studentsID'];
	$studentName = get_student($studentsID);
	$coursesID = intval(mysql_real_escape_string($_GET['coursesID']));
	$assignmentsID = intval(mysql_real_escape_string($_GET['assignmentsID']));

	$rubricsID = get_rubricsID($assignmentsID);
	$result = mysql_query("SELECT * FROM user_rubrics WHERE ID=$rubricsID LIMIT 1");
  	$row = mysql_fetch_array($result);
	$title = $row['title'];
	$rubricHTML = $row['rubric'];
	$total = $row['total'];

	$coursesemestersectionID = get_coursesemestersectionID($coursesID);
	$assignment = get_assignment($assignmentsID);

	update_accessed($studentsID,$assignmentsID);
?>
<!DOCTYPE html>


<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>
        </title>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.css" />
        
        <style>
            /* App custom styles */
        </style>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js">
        </script>
        <script src="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js">
        </script>
       
        <script src="jqswipe.js" type="text/javascript"></script>

        
        <script>
        critIs = [1,2,3];
        critIndex = 0;
		critOf = 3;    	
    	pointsIs = [1,2,3,4,5];
    	pointsIndex = 0;
    	pointsOf = 5;
    	des = [1,2,3,4,5];
    	desIndex = 0;    	
        </script>
        
        <?php
	require_once('./dbconnector.php');

	  global $link;

    $sql = "SELECT DISTINCT courseID FROM courses WHERE instructorsID!=17 AND instructorsID!=12 AND instructorsID!=9 AND instructorsID!=2 AND instructorsID!=24 AND instructorsID!=25 ORDER BY courseID"; //WHERE instructorsID=$instructorsID

  	$result = mysql_query($sql, $link);
  	if (!$result) {
  		echo("<p>Error courses performing query: " . mysql_error() . "</p>");
  		exit();
  	}

  	$courses = array();
  	while ($row = mysql_fetch_array($result)){
  		$courses[] = $row['courseID'];
  	}

	
?>
        
    </head>
    <body>
    	
     
        <div data-role="page" id="page1">
        
       
            <div data-theme="b" data-role="header">
                <h2>
                    Assignment #4
                </h2>
            </div>
           
            <div data-role="content">
                <a data-role="button" data-transition="fade" href="#page2">
                    <?php echo $courses ?>
                    
                </a>
                <a data-role="button" data-transition="fade" href="#page2">
                    Part 1: Artwork Content
                </a>
                <a data-role="button" data-transition="fade" href="#page2">
                    Part 2: Artwork Execution
                </a>
                <a data-role="button" data-transition="fade" href="#page2">
                    Part 3: Writing Content
                </a>
                <a data-role="button" data-transition="fade" href="#page2">
                    Part 4: Writing Quality
                </a>
            </div>
        </div>
         <div data-role="page" id="page2">
            <div data-theme="b" data-role="header">
                <h3>
                    Criterion 
                    
                    
                </h3>
            </div>
            <div data-role="content">
                <div>
                    <b>
                        Points:
                        	<script = "text/javascript">
                        	document.write(pointsIs[pointsIndex] + ' of '+ pointsOf);</script>
                        <br />
                        <br />
                        <br />
                        Description:
                        
                        	 <script = "text/javascript">
                        	document.write('Comment ' + des[desIndex] );</script>  
                        <br />
                        <br />                        
                        <br />
                        <br />
                        Would Benefit from: 
                        
                        Feedback  <script = "text/javascript"> document.write(des[desIndex]);</script>    
                        <br />
                        <br />
                        <br />
                        Additional Comments:
                        
                        Custom Comment <script = "text/javascript"> document.write(des[desIndex]);</script>
                    </b>
                </div>
            </div>
            <a data-role="button" data-transition="fade" href="#page1">
                    Back
                </a>
        </div>
      
        
       
        <script>
          (function() {
// initializes touch and scroll events
        var supportTouch = $.support.touch,
                scrollEvent = "touchmove scroll",
                touchStartEvent = supportTouch ? "touchstart" : "mousedown",
                touchStopEvent = supportTouch ? "touchend" : "mouseup",
                touchMoveEvent = supportTouch ? "touchmove" : "mousemove";

 // handles swipeup and swipedown
        $.event.special.swipeupdown = {
            setup: function() {
                var thisObject = this;
                var $this = $(thisObject);

                $this.bind(touchStartEvent, function(event) {
                    var data = event.originalEvent.touches ?
                            event.originalEvent.touches[ 0 ] :
                            event,
                            start = {
                                time: (new Date).getTime(),
                                coords: [ data.pageX, data.pageY ],
                                origin: $(event.target)
                            },
                            stop;

                    function moveHandler(event) {
                        if (!start) {
                            return;
                        }

                        var data = event.originalEvent.touches ?
                                event.originalEvent.touches[ 0 ] :
                                event;
                        stop = {
                            time: (new Date).getTime(),
                            coords: [ data.pageX, data.pageY ]
                        };

                        // prevent scrolling
                        if (Math.abs(start.coords[1] - stop.coords[1]) > 10) {
                            event.preventDefault();
                        }
                    }

                    $this
                            .bind(touchMoveEvent, moveHandler)
                            .one(touchStopEvent, function(event) {
                        $this.unbind(touchMoveEvent, moveHandler);
                        if (start && stop) {
                            if (stop.time - start.time < 1000 &&
                                    Math.abs(start.coords[1] - stop.coords[1]) > 30 &&
                                    Math.abs(start.coords[0] - stop.coords[0]) < 75) {
                                start.origin
                                        .trigger("swipeupdown")
                                        .trigger(start.coords[1] > stop.coords[1] ? "swipeup" : "swipedown");
                            }
                        }
                        start = stop = undefined;
                    });
                });
            }
        };

//Adds the events to the jQuery events special collection
        $.each({
            swipedown: "swipeupdown",
            swipeup: "swipeupdown"
        }, function(event, sourceEvent){
            $.event.special[event] = {
                setup: function(){
                    $(this).bind(sourceEvent, $.noop);
                }
            };
        });

    })();
    
    	$('div.ui-page').live('swipeup',function() {
		
			critIndex += 1;
			//$.changePage(page2,'slide');
			alert('critIndex is now ' + critIndex);
		
		});
		
		$('div.ui-page').live('swipedown',function() {
		
			critIndex -= 1;
			//$.changePage(page2, 'slide');
			alert('critIndex is now ' + critIndex);
		
		});
		
		$('div.ui-page').live('swiperight', function() {
		
			pointsIndex -=1;
			//$.changePage(page2, 'slide');	
			alert('pointsIndex is now ' + pointsIndex);
	
		});
		
		$('div.ui-page').live('swipeleft', function() {
		
			pointsIndex += 1;
			//$.changePage(page2, 'slide');
			alert('pointsIndex is now ' + pointsIndex);
		});
    
        </script>
     </body>
</html>