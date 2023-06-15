@extends('layouts.main')
    
@section('content')


<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
        <h2>
          Server Environment
        </h2>  
    </div>
    <div class="card-body">
      <?php

        ob_start () ;
        phpinfo (INFO_GENERAL);
        $pinfo = ob_get_contents () ;
        ob_end_clean () ;

        // the name attribute "module_Zend Optimizer" of an anker-tag is not xhtml valide, so replace it with "module_Zend_Optimizer"
        echo ( str_replace ( "module_Zend Optimizer", "module_Zend_Optimizer", preg_replace ( '%^.*<body>(.*)</body>.*$%ms', '$1', $pinfo ) ) ) ;

      ?>
    </div>
  </div>
</div>


@endsection