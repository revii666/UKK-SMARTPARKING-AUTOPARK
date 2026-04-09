<?php
// mqtt/mqtt_config.php

return [
    'broker' => 'broker.emqx.io',
    'port'   => 1883,
    'nama_kelompok' => 'REVICANTIK123',

    // SESUAI ESP32
    'topic_entry_servo' => 'parking/REVICANTIK123/entry/servo',
    'topic_exit_servo'  => 'parking/REVICANTIK123/exit/servo',
];