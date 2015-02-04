<?php


class photosModel
{

	public function getAllPhotos()
	{
		$sql = "SELECT * FROM photo";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query;
	}

	public function uploadPhoto($file, $pathname)
	{
  	  $echo = '';
	  $allowedExts = array("gif", "jpeg", "jpg", "png");
	  $temp = explode(".", $_FILES["file"]["name"]);
	  $exif = exif_read_data($_FILES["file"]["tmp_name"]);
	  $extension = end($temp);

	  if ((($_FILES["file"]["type"] == "image/gif")
	   || ($_FILES["file"]["type"] == "image/jpeg")
	   || ($_FILES["file"]["type"] == "image/jpg")
	   || ($_FILES["file"]["type"] == "image/pjpeg")
	   || ($_FILES["file"]["type"] == "image/x-png")
	   || ($_FILES["file"]["type"] == "image/png"))
	   && ($_FILES["file"]["size"] < 2000000000000)
	   && ((isset($exif['GPS']["GPSLatitude"]))
	   || (isset($exif["GPSLatitude"])))
	   && in_array($extension, $allowedExts))
	   {
		   if ($_FILES["file"]["error"] > 0) {
		    $echo .= "Return Code: " . $_FILES["file"]["error"] . "<br>";
		    $echo = "error";
		   } else {
		     move_uploaded_file($_FILES["file"]["tmp_name"],
		     ROOT .  "public/img/" . $pathname . '.' . $extension);
		     $echo .="Stored in: " . "img/" . $pathname;

		    $exif = exif_read_data(ROOT . 'public/img/' . $pathname . '.' . $extension, 0, true);
		 	$lon = $this->getGps($exif['GPS']['GPSLongitude'], $exif['GPS']['GPSLongitudeRef']);
		 	$lat = $this->getGps($exif['GPS']['GPSLatitude'], $exif['GPS']['GPSLatitudeRef']);

		    $this->savePath($pathname ,$extension, $lon, $lat);
		    $echo = "succes";
		   }

	  }

	   return $echo;

	}
	public function getGps($exifCoord, $hemi) 
	{
	    $degrees = count($exifCoord) > 0 ? $this->gps2Num($exifCoord[0]) : 0;
	    $minutes = count($exifCoord) > 1 ? $this->gps2Num($exifCoord[1]) : 0;
	    $seconds = count($exifCoord) > 2 ? $this->gps2Num($exifCoord[2]) : 0;

	    $flip = ($hemi == 'W' or $hemi == 'S') ? -1 : 1;

	    return $flip * ($degrees + $minutes / 60 + $seconds / 3600);

	}

	 public function gps2Num($coordPart) 
	{

	    $parts = explode('/', $coordPart);

	    if (count($parts) <= 0)
	         return 0;

	    if (count($parts) == 1)
	         return $parts[0];

	    return floatval($parts[0]) / floatval($parts[1]);
	}
  
	 public function savePath($name, $ext, $lon, $lat)
	 {
	  
	  $sql = 'INSERT INTO photo (pathname, longitude, latitude) VALUES ("' . $name . '.' . $ext . '","' . $lon . '","' . $lat . '")';
	  $stmt = $this->db->prepare($sql);

	  $stmt->execute();

	 }

}