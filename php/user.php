<?php

    // include "../EMS/php/koneksi.php";

    function dropDownList()
    {
      $conn = mysqli_connect('localhost','root','','fpprakbasdat');
      $result = mysqli_query($conn,"SELECT divisi.nama_divisi, divisi.id_divisi FROM divisi");
      if (mysqli_num_rows($result) > 0) {
          return $result;
      } else {
          return 0;
      }
      mysqli_close($conn);
    }

    class user
    {
        public $username;
        public $isAdmin;

        function __construct( $username) {
            $this->username = $username;
            $this->isAdmin = false;
        }

        public function getRole()
        {
            return $this->isAdmin;
        }

        public function getUserData($value)
        {
            $conn = mysqli_connect('localhost','root','','fpprakbasdat');
            $result = mysqli_query($conn,"CALL get_user_data('$value')");
            if (mysqli_num_rows($result) > 0) {
                return $result;
            } else {
                return 0;
            }
            mysqli_close($conn);
        }

        public function updateDataUser($value1,$value2,$value3,$value4,$value5,$value6,$value7,$value8,$value9,$value10,$value11,$value12)
        {
            $conn = mysqli_connect('localhost','root','','fpprakbasdat');
            $result = mysqli_query($conn,"CALL update_data_pegawai_user('$value1','$value2','$value3','$value4','$value5','$value6','$value7','$value8','$value9','$value10','$value11','$value12')");
            if( mysqli_affected_rows($conn)>0 ) {
                echo "
                  <script>
                    alert('Update Success');
                    document.location.href = 'account.php';
                  </script>
                ";
              } else {
                echo "
                  <script>
                    alert('Update Failed');
                    document.location.href = 'account.php';
                  </script>
                ";
              }
            mysqli_close($conn);
        }

        public function selectDataPegawai($value,$value2)
        {
            $conn = mysqli_connect('localhost','root','','fpprakbasdat');
            $result = mysqli_query($conn,"CALL select_dataview_for_user('$value','$value2')");
            if (mysqli_num_rows($result) > 0) {
                return $result;
            } else {
                return 0;
            }
            mysqli_close($conn);
        }

        public function selectPegawaiInDiv($value,$mode)
        {
          $conn = mysqli_connect('localhost','root','','fpprakbasdat');
            $result = mysqli_query($conn,"CALL get_emp_in_division('$value','$mode')");
            if (mysqli_num_rows($result) > 0) {
                return $result;
            } else {
                return 0;
            }
            mysqli_close($conn);
        }

        public function selectDivisiInfo()
        {
            $conn = mysqli_connect('localhost','root','','fpprakbasdat');
            $result = mysqli_query($conn,"CALL select_dataview_division()");
            if (mysqli_num_rows($result) > 0) {
                return $result;
            } else {
                return 0;
            }
            mysqli_close($conn);
        }
        
        public function searching($value,$mode)
        {
            $conn = mysqli_connect('localhost','root','','fpprakbasdat');
            $result = mysqli_query($conn,"CALL search_procedure('$value','$mode')");
            if (mysqli_num_rows($result) > 0) {
                return $result;
            } else {
                  echo "
                  <script>
                    alert('Data Not Found');
                  </script>
                ";
                return 0;
            }
            mysqli_close($conn);
        }


    }

    class admin extends user
    {

        function __construct( $username) {
            $this->username = $username;
            $this->isAdmin = true;
        }

        public function selectDataAdmin($value)
        {
            $conn = mysqli_connect('localhost','root','','fpprakbasdat');
            $result = mysqli_query($conn,"CALL select_dataview_for_admin('$value')");
            if (mysqli_num_rows($result) > 0) {
                return $result;
            } else {
                return 0;
            }
            mysqli_close($conn);
        }

        public function insertPegawai($value1,$value2,$value3,$value4,$value5)
        {
            $conn = mysqli_connect('localhost','root','','fpprakbasdat');
            $result = mysqli_query($conn,"CALL insert_to_pegawai('$value1','$value2','$value3','$value4','$value5')");
            if( mysqli_affected_rows($conn)>0 ) {
                echo "
                  <script>
                    alert('Input Success');
                    document.location.href = 'index.php';
                  </script>
                ";
              } else {
                echo "
                  <script>
                    alert('Input Failed');
                  </script>
                ";
              }
            mysqli_close($conn);
        }

        public function insertGaji($value1,$value2,$value3,$value4)
        {
            $conn = mysqli_connect('localhost','root','','fpprakbasdat');
            $result = mysqli_query($conn,"CALL insert_to_gaji('$value1','$value2','$value3','$value4')");
            if( mysqli_affected_rows($conn)>0 ) {
                echo "
                  <script>
                    alert('Input Success');
                    document.location.href = 'penggajian.php';
                  </script>
                ";
              } else {
                echo "
                  <script>
                    alert('Input Failed');
                    document.location.href = 'penggajian.php';
                  </script>
                ";
              }
            mysqli_close($conn);
        }

        public function insertDivisi($value1,$value2)
        {
          $conn = mysqli_connect('localhost','root','','fpprakbasdat');
          $result = mysqli_query($conn,"CALL insert_to_divisi('$value1','$value2')");
          if( mysqli_affected_rows($conn)>0 ) {
              echo "
                <script>
                  alert('Input Success');
                  document.location.href = 'divisi.php';
                </script>
              ";
            } else {
              echo "
                <script>
                  alert('Input Failed');
                </script>
              ";
            }
          mysqli_close($conn);
        }

        public function insertAbsen($value1,$value2)
        {
            $conn = mysqli_connect('localhost','root','','fpprakbasdat');
            $result = mysqli_query($conn,"CALL insert_to_absen('$value1','$value2')");
            if( mysqli_affected_rows($conn)>0 ) {
                echo "
                  <script>
                    alert('Input Success');
                    document.location.href = 'absen.php';
                  </script>
                ";
              } else {
                echo "
                  <script>
                    alert('Input Failed');
                    document.location.href = 'absen.php';
                  </script>
                ";
              }
            mysqli_close($conn);
        }

        public function updateGaji($value1,$value2,$value3,$value4,$value5)
        {
          $conn = mysqli_connect('localhost','root','','fpprakbasdat');
          $result = mysqli_query($conn,"CALL update_gaji('$value1','$value2','$value3','$value4','$value5')");
          if( mysqli_affected_rows($conn)>0 ) {
              echo "
                <script>
                  alert('Update Success');
                  document.location.href = 'penggajian-edit.php';
                </script>
              ";
            } else {
              echo "
                <script>
                  alert('Failed');
                </script>
              ";
            }
          mysqli_close($conn);
        }

        public function updateDivisi($value1,$value2,$value3)
        {
            
          $conn = mysqli_connect('localhost','root','','fpprakbasdat');
          $result = mysqli_query($conn,"CALL update_divisi('$value1','$value2','$value3')");
          if( mysqli_affected_rows($conn)>0 ) {
              echo "
                <script>
                  alert('Update Success');
                  document.location.href = 'divisi.php';
                </script>
              ";
            } else {
              echo "
                <script>
                  alert(' Failed');
                  document.location.href = 'divisi.php';
                </script>
              ";
            }
          mysqli_close($conn);
        }
        
        public function updatePassword($value1,$value2,$value3)
        {
          $conn = mysqli_connect('localhost','root','','fpprakbasdat');
          $result = mysqli_query($conn,"CALL update_password('$value1','$value2','$value3')");
          if( mysqli_affected_rows($conn)>0 ) {
              echo "
                <script>
                  alert('Update Success');
                  document.location.href = 'account.php';
                </script>
              ";
            } else {
              echo "
                <script>
                  alert('May Your Password Wrong');
                </script>
              ";
            }
          mysqli_close($conn);
        }

        public function deleteDataAbsen($value1)
        {
          $conn = mysqli_connect('localhost','root','','fpprakbasdat');
          $result = mysqli_query($conn,"CALL delete_in_absen('$value1')");
          if( mysqli_affected_rows($conn)>0 ) {
              echo "
                <script>
                  alert('Delete Success');
                  document.location.href = 'absen.php';
                </script>
              ";
            } else {
              echo "
                <script>
                  alert('Failed');
                </script>
              ";
            }
          mysqli_close($conn);
        }

        public function updateProfile($value1,$value2,$value3,$value4,$value5,$value6,$value7,$value8,$value9,$value10,$value11,$value12,$value13,$value14)
        {
          $conn = mysqli_connect('localhost','root','','fpprakbasdat');
          $result = mysqli_query($conn,"CALL update_profile_emp_procedure('$value1','$value2','$value3','$value4','$value5','$value6','$value7','$value8','$value9','$value10','$value11','$value12','$value13','$value14')");
          if( mysqli_affected_rows($conn)>0 ) {
              echo "
                <script>
                  alert('Update Success');
                  document.location.href = 'index.php';
                </script>
              ";
            } else {
              echo "
                <script>
                  alert('Failed');
                </script>
              ";
            }
          mysqli_close($conn);

        }
        
        public function filterGaji($value1)
        {
          $conn = mysqli_connect('localhost','root','','fpprakbasdat');
            $result = mysqli_query($conn,"CALL filter_gaji1('$value1')");
            if (mysqli_num_rows($result) > 0) {
                return $result;
            } else {
                return 0;
            }
            mysqli_close($conn);
        }

        public function filterGaji2($value1,$value2)
        {
          $conn = mysqli_connect('localhost','root','','fpprakbasdat');
            $result = mysqli_query($conn,"CALL filter_gaji2($value1,$value2)");
            if (mysqli_num_rows($result) > 0) {
                return $result;
            } else {
              echo "
                  <script>
                    alert('Data Not Found');
                  </script>
                ";
                return 0;
            }
            mysqli_close($conn);
        }

    }


?>