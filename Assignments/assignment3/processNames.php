<?php
// Many notes were added because I was getting lost on what each implode and explode was doing to my strings / data structures
function addClearNames()
{
    if (isset($_POST['clearNames'])) {
        return "";
    }

    if (isset($_POST['addName'])) {

        $newName = trim($_POST['name']);
        $newName = explode(' ', $newName); // ["F L"] becomes {[F],[L]}
        $newName = array_reverse($newName); // {[F],[L]} becomes {[L],[F]}
        $newName = implode(', ', $newName); // {[L],[F]} becomes ["L, F"]
        $textAreaNames = $_POST['namelist'];
        $textAreaArray = explode("\n", $textAreaNames);
        array_push($textAreaArray, $newName);
        sort($textAreaArray);
        $list = implode("\n", $textAreaArray);
        return $list;

}
}
?>