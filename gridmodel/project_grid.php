<?php
include 'db_info.php';
include '../controllers/Project.php';

$aColumns = array('id', 'name', 'image', 'status', 'created_on');

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "id";

/* DB table to use */
$sTable = "projects";

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
        $sWhere .= $aColumns[$i] . " LIKE '%" . $_GET['sSearch'] . "%' OR ";
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
    "iTotalDisplayRecords" => Project::get_total_all_records(),
    "aaData" => array(),
);

$countTableRow = 1;

foreach ($result as $aRow) {
    $row = array();
    for ($i = 0; $i < count($aColumns); $i++) {
        if ($aColumns[$i] == "status") {
            /* Special output formatting for 'status' column */
            if ($aRow[$aColumns[$i]] == "Y") {
                $row[] = '<div class="project_status_disable_enable project_taskStatus' . $countTableRow . '"><a href="javascript:void(0);" title="Disable" row="' . $aRow[$aColumns[0]] . '" value="N" countTableRow="' . $countTableRow++ . '" ><span class="label label-success">Enable</span></a></div>';
            } else if ($aRow[$aColumns[$i]] == "N") {
                $row[] = '<div class="project_status_disable_enable project_taskStatus' . $countTableRow . '"><a href="javascript:void(0);" title="Enable" row="' . $aRow[$aColumns[0]] . '" value="Y" countTableRow="' . $countTableRow++ . '" ><span class="label label-danger">Disable</span></a></div>';
            }
        } else if ($aColumns[$i] == "image") {

            $row[] = '<a href="images/projects/' . $aRow[$aColumns[$i]] . '" target="_blank"><img alt="' . $aRow[$aColumns[$i]] . '" src="images/projects/' . $aRow[$aColumns[$i]] . '" width="100px" height="100px"></a>';

        } else if ($aColumns[$i] != ' ') {
            /* General output */
            $row[] = $aRow[$aColumns[$i]];
        }
    }

    $output['aaData'][] = $row;
}

echo json_encode($output);
