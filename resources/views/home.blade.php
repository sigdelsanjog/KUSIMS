@extends('layouts.app')

@section('content')
<main role="main" class="container">
      <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
        <img class="mr-3" src="/img/ku-logo.png" alt="" width="48" height="48">
        <div class="lh-100">
          <h6 class="mb-0 text-white lh-100">Notice Board</h6>
        </div>
      </div>
      <div class="my-3 p-3 bg-white rounded box-shadow">
          <b-table
            bordered
            :fields="{{$fields}}"
            :items="{{ json_encode($notices) }}">
            <template slot="description" slot-scope="{value, item}">
              <p class="media-body pb-3 mb-0 small">
                <h3 class="d-block text-gray-dark">@{{item.title}}</h3> <span class="badge badge-light">@{{item.created_at | moment}}</span>
              </p>
              <p>
                <span v-html="value"></span>
              </p>
              <p class="text-muted">
                Posted By: <a href="#" class="font-italic text-reset">@{{item.created_by.name}}</a>.
              </p>
            </template>
          </b-table>
      </div>
    </main>
@endsection
