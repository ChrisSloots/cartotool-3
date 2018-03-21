<?php
require_once 'importclass.php';
echo "Import XML<br/>";
echo sprintf('Version: %s<br/>', import::Version());
import::ConnectDB('mysql:host=localhost;dbname=mppng_cartotool', 'root', '' );
echo sprintf('%s<br/>', import::IsConnected()?'Verbonden':'Niet verbonden');

if (import::ImportXML('test1.xml') === TRUE)
{
    echo "Alles OK<br>";
}
else
{
    echo "Er ging iets fout<br>";
};

