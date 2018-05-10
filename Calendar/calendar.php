<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Calendar</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <form>
      <h2 align='center'>Календарь на год
      <input type='number' min='1970' max='2030' name='year'>
      <input type="submit" value="Получить">
      </h2>
    </form>
    <?php
    function draw_calendar($month, $year, $action = 'none') {
    if (isset($_GET['year'])) $year=$_GET['year'];
    if (!isset($year) || $year < 1970 || $year > 2030) $year=date("Y");
    $calendar = '<table cellpadding="0" cellspacing="0" class="calendar_tb">';
      // вывод дней недели
      $dayOfWeek = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];
      $calendar .= '<tr class="calendar_row">';
        for ($day = 0; $day <= 6; $day++) {
        $calendar .= '<th class="calendar_head';
          // выделяем выходные дни
          if($day != 0) {
          if(($day % 5 == 0) || ($day % 6 == 0)) {
          $calendar .= ' calendar_weekend';
          }
          }
          $calendar .= '">';
          $calendar .= '<div class="calendar_number">'.$dayOfWeek[$day].'</div>';
        $calendar .= '</th>';
        }
      $calendar .= '</tr>';
      
      // выставляем начало недели на Пн
      $firstDay = date('w',mktime(0,0,0,$month,1,$year));
      $firstDay = $firstDay - 1;
      if ($firstDay == -1) {
      $firstDay = 6;
      }
      $dayInMonth = date('t', mktime(0,0,0,$month,1,$year));
      $dayCounter = 0;
      $dayInThisWeek = 1;
      $datesArray = [];
      
      // первая строка календаря
      $calendar .= '<tr class="calendar_row">';
        
        // вывод пустых ячеек
        for ($x = 0; $x < $firstDay; $x++) {
        $calendar .= '<td class="calendar_np"></td>';
        $dayInThisWeek++;
        }
        // числа будем записывать в первую строку
        for($listDay = 1; $listDay <= $dayInMonth; $listDay++) {
        $calendar .= '<td class="calendar_day';
          // выделяем выходные дни
          if ($firstDay != 0) {
          if(($firstDay % 5 == 0) || ($firstDay % 6 == 0)) {
          $calendar .= ' calendar_weekend';
          }
          }
          $calendar .= '">';
          
          // пишем номер в ячейку
          $calendar .= '<div class="calendar_number" data-toggle="modal" data-target=".bs-example-modal-sm" data-target="add-text">'.$listDay.'</div>';
        $calendar .= '</td>';
        
        // последний день недели
        if ($firstDay == 6) {
        // закрываем строку
      $calendar .= '</tr>';
      // если день не последний в месяце, начинаем след строку
      if (($dayCounter +1) != $dayInMonth) {
      $calendar .= '<tr class="calendar_row">';
        }
        // сбрасываем счетчики
        $firstDay = -1;
        $dayInThisWeek = 0;
        }
        $dayInThisWeek++;
        $firstDay++;
        $dayCounter++;
        }
        // выводим пустые ячейки в конце последней недели
        if ($dayInThisWeek < 8) {
        for($x = 1; $x <= (8 - $dayInThisWeek); $x++) {
        $calendar .= '<td class="calendar_np"> </td>';
        }
        }
      $calendar .= '</tr>';
    $calendar .= '</table>';
    return $calendar;
    }
    ?>
    <?php
    $months = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
    for ($month = 1; $month <= 12; $month++) { ?>
    <div class="calendar calendar-many">
      <div class="calendar_title">
        <span class="calendar_month">
          <?php echo $months[$month-1] ?>
        </span>
        <span class="calendar_year"><?php echo $_GET['year'] ?></span>
      </div>
      <?php
      echo draw_calendar($month, $year);
      ?>
    </div>
    
    <?php
    }
    ?>
    
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="add-text">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h2>Заметки</h2>
            </div>
            <div class="modal-body">

                <form method="post" enctype="multipart/form-data" role="form">
                    <div class="form-group"><label>Заметка на сегодня</label>
                     <textarea rows="10" cols="30" name="textSet"> </textarea>
                    </div>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-success" name="load">Загрузить</button>

                </form>
            </div>
        </div>
    </div>
</div>
		<?php
      $textSet = filter_input(INPUT_POST, 'textSet');
      $us = [];
      if(isset($_POST['load']) and !empty($_POST['textSet'])) {
          $galleryArray = file_get_contents('notes.txt');
	      if(!empty($galleryArray)){
	      $us = unserialize($galleryArray);
	      }
      array_push($us, ['textSet' => $textSet]);
      $note = serialize($us);
      file_put_contents('notes.txt', $note);
      }
      ?>				
    
    <script src='jquery.min.js'></script>
    <script src="bootstrap.min.js"></script>
<!--    <script src='modal.js'></script>-->
    <script src='main.js'></script>
    
  </body>
</html>