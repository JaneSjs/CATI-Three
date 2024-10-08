@if(request()->segment(1) !== 'begin_survey')
<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
  <div class="sidebar-brand d-none d-md-flex">
    <img src="{{ asset('assets/images/company-logo.png') }}" class="sidebar-brand-full" width="90" height="46" alt="TIFA Logo">
  </div>
  <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
    @canany(['admin','ceo','head','manager'])
    <li class="nav-item">
      <a class="nav-link" href="{{ url('dashboard') }}" aria-label="Dashboard">
        <i class="fa-solid fa-gauge nav-icon" style="color: #fff;"></i> 
        Dashboard
      </a>
    </li>
    @endcan

    @canany(['admin'])
    <li class="nav-group">
      <a class="nav-link nav-group-toggle" href="#">
        System Admin
      </a>
      <ul class="nav-group-items">
        <li class="nav-item" title="Server Environment">
          <a href="{{ url('admin/info') }}" class="nav-link" rel="noreferrer">
            <i class="fa-solid fa-server nav-icon" style="color: #fff;"></i>
            PHP Info
          </a>
        </li>
        <li class="nav-item" title="System Logs">
          <a href="{{ url('admin/log-reader') }}" class="nav-link" rel="noreferrer">
            <i class="fa-solid fa-server nav-icon" style="color: #fff;"></i>
            System Logs
          </a>
        </li>
        <li class="nav-item" title="Maria DB">
          <a href="{{ url('p-dmin') }}" class="nav-link" target="_blank" rel="noreferrer">
            <i class="fa-solid fa-database nav-icon" style="color: #fff;"></i>
            phpMyAdmin
          </a>
        </li>
      </ul>
    </li>
    @endcan

    @if(auth()->id() === 1 || auth()->user()->canany(['admin','dpo']) )
    <li class="nav-group">
      <a class="nav-link nav-title nav-group-toggle" href="#">
        User Management
      </a>
      <ul class="nav-group-items">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fa-solid fa-users-gear nav-icon" style="color: #fff;"></i>
            Sytem Users
          </a>
        </li>
        @if(auth()->user()->can('admin'))
        <li class="nav-item" title="SurveyJS Documentation">
          <a class="nav-link" href="{{ route('roles.index') }}">
            <i class="fa-solid fa-user-lock nav-icon" style="color: #fff;"></i> 
            User Roles
          </a>
        </li>
        @endif
      </ul>
    </li>
    @endif
    

    @canany(['admin','ceo','head','manager','dpo'])
    <li class="nav-group">
      <a class="nav-link nav-title nav-group-toggle" href="#">
        Learning
      </a>
      <ul class="nav-group-items">
        <li class="nav-item" title="SurveyJS Documentation">
          <a href="https://surveyjs.io/survey-creator/documentation/end-user-guide/user-interface" class="nav-link" rel="noreferrer" target="_blank">
            <i class="fa-solid fa-square-poll-horizontal nav-icon" style="color: #fff;"></i>
            Survey Js
          </a>
        </li>
        <li class="nav-item" title="Metabase Documentation">
          <a href="https://www.metabase.com/learn/metabase-basics/getting-started/introduction" class="nav-link" rel="noreferrer" target="_blank">
            <i class="fa-solid fa-chart-line nav-icon" style="color: #fff;"></i>
            Metabase
          </a>
        </li>
      </ul>
    </li>
    @endcan

    <li class="nav-group">
      <a class="nav-link nav-title nav-group-toggle" href="#">
        Research
      </a>
      <ul class="nav-group-items">
        @canany(['admin','ceo','head','manager','scripter','coordinator','supervisor','interviewer','qc','client','dpo','finance'])
        <li class="nav-item">
          <a class="nav-link" href="{{ route('projects.index') }}">
            <i class="fa-solid fa-folder-open nav-icon" style="color: #fff;"></i> 
            Projects
          </a>
        </li>
        @endcan

        @canany(['admin','ceo','head','manager'])
        <li class="nav-item">
          <a class="nav-link" href="{{ route('clients') }}">
            <i class="fa-solid fa-face-smile nav-icon" style="color: #e5a50a;"></i>
            Clients
          </a>
        </li>
        @endcan

        @canany(['admin','ceo','supervisor'])
        <li class="nav-item">
          <a class="nav-link" href="{{ route('interviewers') }}">
            <i class="fa-solid fa-headphones nav-icon" style="color: #e5a50a;"></i>
            <!--<i class="cis-headphones nav-icon" style="color: #e5a50a;"></i>-->
            Interviewers
          </a>
        </li>
        @endcan
      </ul>
    </li>

    @canany(['admin'])
    <li class="nav-group" title="Jobs Kona is Coming Soon">
      <a class="nav-link nav-group-toggle" href="#">
        <i class="fa-solid fa-laptop-file nav-icon" style="color: #e5a50a;"></i>
        Jobs Kona
      </a>
      <ul class="nav-group-items">
        <li class="nav-item" title="Job Listings">
          <a href="javascript:void" class="nav-link" rel="noreferrer">
            <i class="fa-solid fa-server nav-icon" style="color: #fff;"></i>
            Job Listings
          </a>
        </li>
        <li class="nav-item" title="Applicants">
          <a href="{{ route('applicants.index') }}" class="nav-link" rel="noreferrer">
            <i class="fa-solid fa-server nav-icon" style="color: #fff;"></i>
            Applicants
          </a>
        </li>
      </ul>
    </li>
    @endcan

    @canany(['admin','ceo','head','manager'])
    <li class="nav-item">
      <a class="nav-link" href="http://dashboard.tifaresearch.com:3000" target="_blank">
        <i class="fa-solid fa-chart-simple text-primary nav-icon" style="color: #fff;"></i> 
          Metabase
      </a>
    </li>
    @endcan

    @canany(['admin','ceo','finance'])
    <li class="nav-group">
      <a class="nav-link nav-group-toggle" href="#">
        <strong>Incentives</strong>
      </a>
      <ul class="nav-group-items">
        <li class="nav-item" title="SMS">
          <a href="#" onclick="alert('Coming Soon')" class="nav-link" rel="noreferrer">
            <i class="fa-solid fa-message nav-icon" style="color: #fff;"></i>
            SMS
          </a>
        </li>
        <li class="nav-item" title="Airtime">
          <a href="#" onclick="alert('Coming Soon')" class="nav-link" rel="noreferrer">
            <i class="fa-solid fa-phone nav-icon" style="color: #fff;"></i>
            Airtime
          </a>
        </li>
        <li class="nav-item" title="Internet Bundles">
          <a href="#" onclick="alert('Coming Soon')" class="nav-link" target="_blank" rel="noreferrer">
            <i class="fa-solid fa-database nav-icon" style="color: #fff;"></i>
            Data Bundles
          </a>
        </li>
      </ul>
    </li>
    @endcan
        
    @canany(['admin','ceo','head','manager','coordinator','dpo'])
    <li class="nav-group">
      <a class="nav-title nav-link nav-group-toggle" href="#">
         Data Protection
       </a>
      <ul class="nav-group-items">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('respondents.index') }}">
            <i class="fa-solid fa-database nav-icon" style="color: #fff;"></i> 
            Data Processing
          </a>
        </li>
        <li class="nav-item" title="RDMS">
          <button type="button" class="nav-link" title="RDMS" data-coreui-toggle="modal" data-coreui-target="#rdms">
            <i class="fa-solid fa-server nav-icon" style="color: #fff;"></i>
            Data Controlling
          </button>
        </li>
      </ul>
    </li>
    @endcan

    @canany(['admin','ceo'])
    <li class="nav-group" title="Coming Soon">
      <a class="nav-title nav-link nav-group-toggle" href="#">
        Performance Reports
      </a>
      <ul class="nav-group-items">
        <li class="nav-item" title="Project Managers Report Coming Soon">
          <a href="javascript:void" class="nav-link" rel="noreferrer">
            <i class="fa-solid fa-users-rectangle nav-icon" style="color: #fff;"></i>
            Project Managers
          </a>
        </li>
        <li class="nav-item" title="Supervisors Report Coming Soon">
          <a href="javascript:void" class="nav-link" rel="noreferrer">
            <i class="fa-solid fa-users-viewfinder nav-icon" style="color: #fff;"></i>
            Supervisors
          </a>
        </li>
        <li class="nav-item" title="QC's Report Coming Soon">
          <a href="javascript:void" class="nav-link" rel="noreferrer">
            <i class="fa-solid fa-users-between-lines nav-icon" style="color: #fff;"></i>
            QC's
          </a>
        </li>
        <li class="nav-item" title="Interviewers Report Coming Soon">
          <a href="javascript:void" class="nav-link" rel="noreferrer">
            <i class="fa-solid fa-users-rays nav-icon" style="color: #fff;"></i>
            Interviewers
          </a>
        </li>
      </ul>
    </li>
    @endcan

    @canany(['admin','ceo','head','manager'])
    <li class="nav-group">
      <a class="nav-title nav-link nav-group-toggle" href="#">
        Data Converters
      </a>
      <ul class="nav-group-items">
        <li class="nav-item" title="Convert JSON To CSV">
          <a href="{{ route('converters.index') }}" class="nav-link" rel="noreferrer">
            <i class="fa-solid fa-gear fa-spin-pulse nav-icon" style="color: #fff;"></i>
            JSON To CSV
          </a>
        </li>
        <li class="nav-item" title="Convert PDF to Word">
          <a href="" class="nav-link" rel="noreferrer" disabled>
            <i class="fa-solid fa-gear fa-spin-pulse nav-icon" style="color: #fff;"></i>
            PDF To Word
          </a>
        </li>
      </ul>
    </li>
    @endcan
  </ul>
  <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
@endif


<!-- RDMS Modal -->
<div class="modal fade" id="rdms" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="rdmsLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-light" id="rdmsLabel">
          <i class="fa-solid fa-server nav-icon" style="color: #fff;"></i>
          RDMS
        </h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-warning">
        Controlled database is managed from the RDMS system
        <a href="https://rdms.tifaresearch.com/" target="_blank" class="btn btn-outline-primary text-dark float-end">
          Go To RDMS ?
        </a>
      </div>
    </div>
  </div>
</div>
<!-- End RDMS Modal -->
