<?php

require "vendor/autoload.php";

// Initialize the Supabase service with your API key and URL
$service = new PHPSupabase\Service(
    "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImRhamJ6eWtvYm1tcmZycWdua2NoIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjI4OTk1NzksImV4cCI6MjAzODQ3NTU3OX0.NiOd3QYux8zFa4QsG4zYLAcwrYODd2NUVNehuIG8hh8", 
    "https://dajbzykobmmrfrqgnkch.supabase.co"
);

// $supabase = $service->initialize();

// If you are using a version 0.0.4 or earlier, you would need to include the suffix
// Uncomment the following lines if that's the case
/*
$service = new PHPSupabase\Service(
    "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImRhamJ6eWtvYm1tcmZycWdua2NoIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjI4OTk1NzksImV4cCI6MjAzODQ3NTU3OX0.NiOd3QYux8zFa4QsG4zYLAcwrYODd2NUVNehuIG8hh8", 
    "https://dajbzykobmmrfrqgnkch.supabase.co/auth/v1" // or "https://dajbzykobmmrfrqgnkch.supabase.co/rest/v1"
);
*/

?>

