<?php
include 'db_info.php';
include '../controllers/Task.php';

$aColumns = array('tasks.id', 'projects.name as project_name', 'tasks.name', 'tasks.status', 'tasks.created_on');

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "tasks.id";

/* DB table to use */
$sTable = "tasks";

// Joins
$sJoin = ' inner join projects on projects.id = tasks.project_id';

// if ($_GET['sSearch'] == "") {
//     $myWhere = " Order by  id  desc";
// } else {
//     $myWhere = " Order by  id  desc";
// }

/*
 * Paging
 */
$sLimit = "";
if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
    $sLimit .= 'LIMIT ' . $_GET['iDisplayStart'] . ', ' . $_GET['iDisplayLength'];

}

/*
 * Ordering
 */
if (isset($_GET['iSortCol_0'])) {
    $sOrder = "ORDER BY  ";
    for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
        if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
            $sOrder .= $aColumns[intval($_GET['iSortCol_' . $i])] . "
				 	" . $_GET['sSortDir_' . $i] . ", ";
        }
    }

    $sOrder = substr_replace($sOrder, "", -2);
    if ($sOrder == "ORDER BY") {
        $sOrder = "";
    }
}

/*
 * Filtering
 * NOTE this does not match the built-in DataTables filtering which does it
 * word by word on any field. It's possible to do here, but concerned about efficiency
 * on very large tables, and MySQL's regex functionality is very limited
 */
$sWhere = "";
if ($_GET['sSearch'] != "") {
    $sWhere = "WHERE (";
    for ($i = 0; $i < count($aColumns); $i++) {
        if ($aColumns[$i] != 'projects.name as project_name') {
            $sWhere .= $aColumns[$i] . " LIKE '%" . $_GET['sSearch'] . "%' OR ";
        }

    }
    $sWhere = substr_replace($sWhere, "", -3);
    $sWhere .= ')';
}

/* Individual column filtering */
for ($i = 0; $i < count($aColumns); $i++) {
    if ($_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
        if ($sWhere == "") {
            $sWhere = "WHERE ";
        } else {
            $sWhere .= " AND ";
        }
        $sWhere .= $aColumns[$i] . " LIKE '%" . $_GET['sSearch_' . $i] . "%' ";
    }
}

/*
 * SQL queries
 * Get data to display
 */
$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
		FROM   $sTable
		$sJoin
		$sWhere
		$sOrder
		$sLimit
	";

$statement = $connection->prepare($sQuery);
$statement->execute();
$result = $statement->fetchAll();
$filtered_rows = $statement->rowCount();

$output = array(
    "sEcho" => intval($_GET['sEcho']),
    "iTotalRecords" => $filtered_rows,
    "iTotalDisplayRecords" => Task::get_total_all_records(),
    "aaData" => array(),
);

$countTableRow = 1;

foreach ($result as $aRow) {

    $row = array();
    for ($i = 0; $i < count($aColumns); $i++) {
        if ($aColumns[$i] == "tasks.id") {
            /* General output */
            $row[] = $aRow['id'];
        }
        if ($aColumns[$i] == "projects.name as project_name") {
            /* General output */
            $row[] = $aRow['project_name'];
        }
        if ($aColumns[$i] == "tasks.name") {
            /* General output */
            $row[] = $aRow['name'];
        }
        if ($aColumns[$i] == "tasks.status") {
            /* General output */
            $row[] = $aRow['status'];
        }
        if ($aColumns[$i] == "tasks.created_on") {
            /* General output */
            $row[] = $aRow['created_on'];
        }

    }

    $output['aaData'][] = $row;
}

echo json_encode($output);
