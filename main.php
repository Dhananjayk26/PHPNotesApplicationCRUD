<?php


//below add notes
$sql="select * from notes";
//$result=mysqli_query($conn,$sql);
if(!$result)
{
echo"NO Data";
}
/*while($row=mysqli_fetch_assoc($result))
{
    echo "<br>ID :".$row['id']."<br>Key Point :".$row['keypoint']."<br>Description :".$row['description']."<br>Date&Time :".$row['time'];
}*/
?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>