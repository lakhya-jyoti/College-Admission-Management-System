<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link" href="<?= $web_socket ?>administration/">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->


    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gem"></i><span>Applicants</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="manage-applicants.php">
            <i class="bi bi-circle"></i><span>Manage Applicants</span>
          </a>
        </li>
        <li>
          <a href="manage-approved.php">
            <i class="bi bi-circle"></i><span>Approved Applicants</span>
          </a>
        </li>
        <li>
          <a href="<?= $web_socket ?>administration/approved-list.php">
            <i class="bi bi-circle"></i><span>Program Wise Approved List</span>
          </a>
        </li>
      </ul>
    </li><!-- End Icons Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>Program</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?= $web_socket ?>administration/add-program.php">
            <i class="bi bi-circle"></i><span>Add Program</span>
          </a>
        </li>

        <li>
          <a href="<?= $web_socket ?>administration/add-program-subjects.php">
            <i class="bi bi-circle"></i><span>Add Program's Subjects</span>
          </a>
        </li>
        <li>
          <a href="<?= $web_socket ?>administration/manage-program.php">
            <i class="bi bi-circle"></i><span>Manage Program</span>
          </a>
        </li>
        <!-- <li>
          <a href="<?= $web_socket ?>administration/viwe-program-subjects.php">
            <i class="bi bi-circle"></i><span>Manage Program Subjects</span>
          </a>
        </li> -->

      </ul>
    </li><!-- End Components Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Department</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?= $web_socket ?>administration/add-dept.php">
            <i class="bi bi-circle"></i><span>Add Department</span>
          </a>
        </li>
        <li>
          <a href="<?= $web_socket ?>administration/manage-dept.php">
            <i class="bi bi-circle"></i><span>Manage Department</span>
          </a>
        </li>
      </ul>
    </li><!-- End Forms Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Subjects</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?= $web_socket ?>administration/add-subject.php">
            <i class="bi bi-circle"></i><span>Add Subjects</span>
          </a>
        </li>
        <li>
          <a href="<?= $web_socket ?>administration/manage-subject.php">
            <i class="bi bi-circle"></i><span>Manage Subjects</span>
          </a>
        </li>
      </ul>
    </li><!-- End Tables Nav -->

    
    <!-- <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#charts-nv" data-bs-toggle="collapse" href="#">
        <i class="bi bi-bar-chart"></i><span>Admitted Student List</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="charts-nv" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?= $web_socket ?>administration/prgm-wise-std-list.php">
            <i class="bi bi-circle"></i><span>Program Wise</span>
          </a>
        </li>
     
        <li>
          <a href="<?= $web_socket ?>administration/prgm-sub-wise-std-list.php">
            <i class="bi bi-circle"></i><span>Program Subject Wise</span>
          </a>
        </li>
     
        <li>
          <a href="<?= $web_socket ?>administration/approved-list.php">
            <i class="bi bi-circle"></i><span>Program Wise Approved List</span>
          </a>
        </li>
     
      </ul> -->
    </li><!-- End Charts Nav -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#charts-n" data-bs-toggle="collapse" href="#">
        <i class="bi bi-bar-chart"></i><span>HS Merit</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="charts-n" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?= $web_socket ?>administration/hs-merit-list-generation.php">
            <i class="bi bi-circle"></i><span>Merit List</span>
          </a>
        </li>
       
      </ul>
    </li><!-- End Charts Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#chart-n" data-bs-toggle="collapse" href="#">
        <i class="bi bi-bar-chart"></i><span>UG Merit</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="chart-n" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?= $web_socket ?>administration/ba-merit-list-generation-all.php">
            <i class="bi bi-circle"></i><span>BA Merit List (All)</span>
          </a>
        </li>
        <li>
          <a href="<?= $web_socket ?>administration/ba-merit-list-generation.php">
            <i class="bi bi-circle"></i><span>BA Merit List (Subject-wise)</span>
          </a>
        </li>
        <li>
          <a href="<?= $web_socket ?>administration/bsc-merit-list-generation-all.php">
            <i class="bi bi-circle"></i><span>BSC Merit List (All)</span>
          </a>
        </li>
        <li>
          <a href="<?= $web_socket ?>administration/bsc-merit-list-generation.php">
            <i class="bi bi-circle"></i><span>BSC Merit List (Subject-wise)</span>
          </a>
        </li>
        <li>
          <a href="<?= $web_socket ?>administration/bca-merit-list-generation-all.php">
            <i class="bi bi-circle"></i><span>BCA Merit List (All)</span>
          </a>
        </li>
        <li>
          <a href="<?= $web_socket ?>administration/bpes-merit-list-generation.php">
            <i class="bi bi-circle"></i><span>BPES Merit List (All)</span>
          </a>
        </li>
       
      </ul>
    </li><!-- End Charts Nav -->

    <li class="nav-item">
     
      <ul id="charts-na" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?= $web_socket ?>administration/merit-list-selection.php">
            <i class="bi bi-circle"></i><span>Merit Selection Entry</span>
          </a>
        </li>
       
      </ul>
    </li><!-- End Charts Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-bar-chart"></i><span>Report Generation</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <!-- <li>
          <a href="<?= $web_socket ?>administration/generate-merit-list.php">
            <i class="bi bi-circle"></i><span>Merit List</span>
          </a>
        </li>
      -->

      <!-- <?php

$select = "select * from program";
$stmt = $con->prepare($select);
$stmt->execute();
$fetch_prgm_id = $stmt->fetch(PDO::FETCH_ASSOC);

?> -->
        <li>
          <a href="<?= $web_socket ?>administration/all-app-list-entry.php">
            <i class="bi bi-circle"></i><span>All Applicants List</span>
          </a>
        </li>
        <li>
          <a href="<?= $web_socket ?>administration/hs-sc-all-std-list.php">
            <i class="bi bi-circle"></i><span>HS SC Admitted Students (All)</span>
          </a>
        </li>
        <li>
          <a href="<?= $web_socket ?>administration/hs-arts-all-std-list.php">
            <i class="bi bi-circle"></i><span>HS ARTS Admitted Students (All)</span>
          </a>
        </li>    
        <li>
          <a href="<?= $web_socket ?>administration/hs-com-all-std-list.php">
            <i class="bi bi-circle"></i><span>HS Commerce Admitted Students (All)</span>
          </a>
        </li>
           
        <li>
          <a href="<?= $web_socket ?>administration/ba-all-std-list.php">
            <i class="bi bi-circle"></i><span>BA Admitted Students (All)</span>
          </a>
        </li>
        
        <li>
          <a href="<?= $web_socket ?>administration/ba-sub-std-list.php">
          <i class="bi bi-circle"></i><span>BA Admitted Students (Subject Wise)</span>

          </a>
        </li>
        <li>
          <a href="<?= $web_socket ?>administration/bsc-all-std-list.php">
            <i class="bi bi-circle"></i><span>BSC Admitted Students (All)</span>
          </a>
        </li>
        
        <li>
          <a href="<?= $web_socket ?>administration/bsc-sub-std-list.php?id=12">
          <i class="bi bi-circle"></i><span>BSC Admitted Students (Subject Wise)</span>

          </a>
        </li>

        <li>
          <a href="<?= $web_socket ?>administration/bca-std-list.php">
            <i class="bi bi-circle"></i><span>Admitted Students BCA (All)</span>
          </a>
        </li>
        <li>
          <a href="<?= $web_socket ?>administration/bpes-std-list.php">
            <i class="bi bi-circle"></i><span>Admitted Students BPES (All)</span>
          </a>
        </li>


     
        <!-- <li>
          <a href="<?= $web_socket ?>administration/approved-list.php">
            <i class="bi bi-circle"></i><span>Program Wise Approved List</span>
          </a>
        </li> -->
     
      </ul>
    </li><!-- End Charts Nav -->

  </ul>

</aside>