@extends('app')
@section('content')

  <div class="form-group row add">
    <div class="col-md-12">
      <h1>Football players and football teams App - Laravel Vue.js CRUD</h1>
    </div>
    <div class="col-md-12">
      <button type="button" data-toggle="modal" data-target="#create-player" class="btn btn-primary">
        Add a football team
      </button>
    </div>
  </div>
  <div class="row">
    <div class="table-responsive">
      <table class="table table-borderless">
        <tr>
          <th>FOOTBALL TEAMS NAMES</th>
        </tr>
        <tr v-for="team in teams">
          <td>@{{ team.name }}</td>
            <button class="edit-modal btn btn-warning" @click.prevent="editTeam(team)">
              <span class="glyphicon glyphicon-edit"></span> Edit
            </button>
            <button class="edit-modal btn btn-danger" @click.prevent="deleteTeam(team)">
              <span class="glyphicon glyphicon-trash"></span> Delete
            </button>
          </td>
        </tr>
      </table>
    </div>
  </div>
  <nav>
    <ul class="pagination">
      <li v-if="pagination.current_page > 1">
        <a href="#" aria-label="Previous" @click.prevent="changePage(pagination.current_page - 1)">
          <span aria-hidden="true">«</span>
        </a>
      </li>
      <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
        <a href="#" @click.prevent="changePage(page)">
          @{{ page }}
        </a>
      </li>
      <li v-if="pagination.current_page < pagination.last_page">
        <a href="#" aria-label="Next" @click.prevent="changePage(pagination.current_page + 1)">
          <span aria-hidden="true">»</span>
        </a>
      </li>
    </ul>
  </nav>
  <!-- Create Team Modal -->
  <div class="modal fade" id="create-team" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Create a new team</h4>
        </div>
        <div class="modal-body">
          <form method="post" enctype="multipart/form-data" v-on:submit.prevent="createTeam">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" class="form-control" v-model="newTeam.name" />
              <span v-if="formErrors['name']" class="error text-danger">
                @{{ formErrors['first_name'] }}
              </span>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<!-- Edit Team Modal -->
<div class="modal fade" id="edit-team" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Edit Team</h4>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" v-on:submit.prevent="updateTeam(fillTeam.id)">
          <div class="form-group">
            <label for="name">Team new name:</label>
            <input type="text" name="name" class="form-control" v-model="fillTeam.name" />
            <span v-if="formErrorsUpdate['name']" class="error text-danger">
              @{{ formErrorsUpdate['name'] }}
            </span>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@stop
