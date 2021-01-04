<?php
    /**
     * Constructs the table for the events
     */
    class Table
    {
      private $body;
      function __construct($data)
      {
        $this->body = '<table id="mainTable" class="table table-striped">';
        $this->body .= '<thead><tr><th>Category</th><th>Name</th>';
        $this->body .= '<th>Description</th><th>Location</th><th>Date & Time</th>';
        $this->body .= '<th>Rating</th></tr></thead><tbody>';
        foreach ($data as $value) {
          $this->body .= $this->createRow($value);
        }
        $this->body .= '</tbody></table>';
      }

      /**
       * fills the table with events.
       */
      function createRow($rowData)
      {
        $date = date_create($rowData["EventDate"]);
        $date = date_format($date, "d/m/Y H:i");
        $event_link = "eventPage.php?" . $rowData["Name"];
        $row = '<tr><td>' . $rowData["Category"] . '</td>';
        $row .= '<td><a href="eventPage.php?id=' . $rowData["EventId"] . '">' . $rowData["E_Name"] . '</a></td>';
        $row .= '<td>' . $rowData["Description"] . '</td>';
        $row .= '<td>' . $rowData["Place"] . '</td>';
        $row .= '<td>' . $date . '</td>';
        $row .= '<td>' . $rowData["Rating"] . '</td></tr>';
        return $row;
      }

      /**
       * Returns the table.
       */
      function getBody()
      {
        return $this->body;
      }

    }

  ?>
