Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
new Vue({
  el :'#manage-vue',
  data :{
    players: [],
	teamselected: '',
    pagination: {
      total: 0,
      per_page: 2,
      from: 1,
      to: 0,
      current_page: 1
    },
    offset: 4,
    formErrors:{},
    formErrorsUpdate:{},
    newPlayer : {'first_name':'','last_name':'team_id'},
    fillPlayer : {'first_name':'','last_name':'team_id'}
  },
  computed: {
    isActived: function() {
      return this.pagination.current_page;
    },
    pagesNumber: function() {
      if (!this.pagination.to) {
        return [];
      }
      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }
      var to = from + (this.offset * 2);
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }
      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    }
  },
  ready: function() {
    this.getVuePlayers(this.pagination.current_page);
  },
  methods: {
    getVuePlayers: function(page) {
      this.$http.get('/playersvueitems?page='+page).then((response) => {
        this.$set('players', response.data.data.data);
        this.$set('pagination', response.data.pagination);
      });
    },
    createPlayer: function() {
      var player = this.newPlayer;
      this.$http.post('/playersvueitems',player).then((response) => {
        this.changePage(this.pagination.current_page);
        this.newPlayer = {'first_name':'','last_name':'team_id'};
        $("#create-player").modal('hide');
        toastr.success('Player Created Successfully.', 'Success Alert', {timeOut: 5000});
      }, (response) => {
        this.formErrors = response.data;
      });
    },
    deletePlayer: function(player) {
      this.$http.delete('/vueplayers/'+ player.id).then((response) => {
        this.changePage(this.pagination.current_page);
        toastr.success('Player Deleted Successfully.', 'Success Alert', {timeOut: 5000});
      });
    },
    editPlayer: function(item) {
      this.fillPlayer.first_name=  Player.first_name;
      this.fillPlayer.last_name = Player.last_name;
      this.fillPlayer.team_id = Player.team_id;
      $("#edit-item").modal('show');
    },
    updatePlayer: function(id) {
      var input = this.fillPlayer;
      this.$http.put('/vueitems/'+id,input).then((response) => {
        this.changePage(this.pagination.current_page);
        this.newPlayer = {'first_name':'','last_name':'','team_id':''};
        $("#edit-player").modal('hide');
        toastr.success('Player Updated Successfully.', 'Success Alert', {timeOut: 5000});
      }, (response) => {
        this.formErrors = response.data;
      });
    },
    changePage: function(page) {
      this.pagination.current_page = page;
      this.getVuePlayers(page);
    }
  }
});
