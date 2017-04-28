@extends('app')
@section('content')

  <div class="form-group row add">
    <div class="col-md-12">
      <h1>Football players and football teams App - Laravel Vue.js CRUD</h1>
    </div>
    <div class="col-md-12">
      <button type="button" data-toggle="modal" data-target="#create-player" class="btn btn-primary">
        Add a new player
      </button>
    </div>
  </div>
  <div class="row">
    <div class="table-responsive">
      <table class="table table-borderless">
        <tr>
          <th>FIRST NAME</th>
          <th>LAST NAME</th>
          <th>TEAM</th>
        </tr>
        <tr v-for="player in players">
          <td>@{{ player.first_name }}</td>
          <td>@{{ player.last_name }}</td>
          <td>@{{ player->team->name }}</td>
          <td>
            <button class="edit-modal btn btn-warning" @click.prevent="editPlayer(player)">
              <span class="glyphicon glyphicon-edit"></span> Edit
            </button>
            <button class="edit-modal btn btn-danger" @click.prevent="deletePlayer(player)">
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
  <!-- Create Player Modal -->
  <div class="modal fade" id="create-player" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Create New Player</h4>
        </div>
        <div class="modal-body">
          <form method="post" enctype="multipart/form-data" v-on:submit.prevent="createPlayer">
            <div class="form-group">
              <label for="first_name">First name</label>
              <input type="text" name="first_name" class="form-control" v-model="newPlayer.first_name" />
              <span v-if="formErrors['first_name']" class="error text-danger">
                @{{ formErrors['first_name'] }}
              </span>
            </div>
            <div class="form-group">
              <label for="last_name">Last name</label>
              <input name="last_name" class="form-control" v-model="newPlayer.last_name">
              <span v-if="formErrors['last_name']" class="error text-danger">
                @{{ formErrors['last_name'] }}
              </span>
            </div>
			<div class="form-group">
              <label for="team">Team</label>
				<select v-model="teamselected">
					@foreach ($teams as $team)
						<option value="{{ $team->id }}">{{ $team->name }}</option>				
						</option>
					@endforeach	
				</select>			  			  
			  <span v-if="formErrors['team']" class="error text-danger">
                @{{ formErrors['team'] }}
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
<!-- Edit Player Modal -->
<div class="modal fade" id="edit-player" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Edit Player</h4>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" v-on:submit.prevent="updatePlayer(fillPlayer.id)">
          <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" class="form-control" v-model="fillPlayer.first_name" />
            <span v-if="formErrorsUpdate['first_name']" class="error text-danger">
              @{{ formErrorsUpdate['first_name'] }}
            </span>
          </div>
          <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input name="last_name" class="form-control" v-model="fillPlayer.last_name">
            <span v-if="formErrorsUpdate['last_name']" class="error text-danger">
              @{{ formErrorsUpdate['last_name'] }}
            </span>
          </div>
		  <div class="form-group">
				<label for="team">Team</label>
					<select v-model="teamselected">
						@foreach ($teams as $team)
							<option value="{{ $team->id }}">{{ $team->name }}</option>				
							</option>
						@endforeach	
					</select>			  			  
					<span v-if="formErrors['team']" class="error text-danger">
						@{{ formErrors['team'] }}
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
