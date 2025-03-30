<?php
include('../class.php');

$db = new global_class();

if (isset($_POST['pet_id'])) {
    $petId = $_POST['pet_id'];

    // Fetch vaccination history
    $result = $db->get_vaccination_history($petId);

    $html = '';
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $html .= '<tr>';
            $html .= '<td>' . date('M d, Y h:i A', strtotime($row['ph_update_at'])) . '</td>';
            $html .= '<td>' . ($row['ph_pet_antiRabies_expi_date'] ? date('M d, Y', strtotime($row['ph_pet_antiRabies_expi_date'])) : 'Not set') . '</td>';
            $html .= '<td>' . ($row['ph_pet_antiRabies_vac_date'] ? date('M d, Y', strtotime($row['ph_pet_antiRabies_vac_date'])) : 'Not given') . '</td>';
            $html .= '</tr>';
        }
    } else {
        $html = '<tr><td colspan="3">No vaccination history found</td></tr>';
    }

    echo $html;
} else {
    echo '<tr><td colspan="3">Invalid request</td></tr>';
}
?>
