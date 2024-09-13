@extends('layouts.main')
    
@section('content')

<div class="body flex-grow-1 px-3">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          <h4 class="text-primary">
            Interviewers
          </h4>
        </div>
        <div class="col">
          @include('partials/alerts')
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row">

        <div class="col-9">
          <div class="table-responsive">
            <table class="table caption-top table-striped table-bordered">
              @canany(['admin','ceo','head','manager'])
                <caption>
                  Interviewers List
                </caption>
              @endcan
              <thead class="table-success">
                <tr>
                  <th scope="col">Name</th>
                  @canany(['admin'])
                  <th scope="col">Phone No</th>
                  @endcan
                  <th scope="col">Ext No</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($interviewers as $interviewer)
                <tr>
                  <th scope="row">
                    <i class="fas fa-eye"></i>
                    <a href="{{ route('users.show', $interviewer->id) }}">
                      {{ $interviewer->first_name . ' ' . $interviewer->last_name  }}
                    </a>
                  </th>
                  @canany(['admin'])
                    <td>
                      {{ $interviewer->phone_1 }}
                      @if($interviewer->phone_2)
                      <hr>
                        {{ $interviewer->phone_2 }}
                      @endif
                      @if($interviewer->phone_3)
                      <hr>
                        {{ $interviewer->phone_3 }}
                      @endif
                    </td>
                  @endcan
                  <td>
                    {{ $interviewer->ext_no }}
                  </td>
                  <td>
                    <div class="btn-group">
                      @canany(['admin','ceo','supervisor'])
                      <button type="button" class="btn btn-outline-primary" title="Reset Ext No {{ $interviewer->ext_no }}" data-coreui-toggle="modal" data-coreui-target="#resetExtNo-{{ $interviewer->id }}">
                        <div class="icon me-2">
                          <i class="fa-solid fa-square-phone"></i>
                        </div>Reset Ext No
                      </button>
                      @include('users.modals.reset_ext_no')
                      @endcan
                      @canany(['admin'])
                      <form action="{{ route('users.destroy', $interviewer->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Remove {{ $interviewer->last_name }}">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      </form>
                    </div>
                    @endcan
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                {{ $interviewers->links() }}
              </tfoot>
            </table>
          </div>
        </div>
        @canany(['admin','ceo','head','supervisor'])
          <div class="col-3 bg-secondary">
           {{ count($interviewers) }} Interviewers
          </div>
        @endcan
      </div>
    </div>
  </div>
</div>

@endsection