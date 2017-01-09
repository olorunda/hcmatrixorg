<?php 
$idpgoals = app('App\Repositories\EmployeeRepository')->getGoalTo(Auth::user()->id, $direct->id, 3); 
$glcnt = count($idpgoals); 
?>
@if($glcnt > 0)
<div class="row row-lg">
  <div class="col-md-12 col-xs-12">
    <div class="panel panel-bordered" style="margin-bottom: 4px;">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-graduation-cap"></i>Individual Development Plans</h3>
      </div>
      <div class="panel-body">
        <div class="panel-group panel-group-simple" id="idp{{$direct->id}}" aria-multiselectable="true" role="tablist">
          @foreach($idpgoals as $idpgoal)
          <div class="panel">
            <div class="panel-heading" id="pilotHeadingModal1{{$direct->id}}{{$idpgoal->id}}" role="tab">
              <a class="panel-title" data-toggle="collapse" href="#pilotcollapsModal1{{$direct->id}}{{$idpgoal->id}}" data-parent="#idp{{$direct->id}}" aria-expanded="false" aria-controls="pilotcollapsModal1{{$direct->id}}{{$idpgoal->id}}">
                <h5 class="text-warning">Commitment</h5>
              </a>
              <span class="text-default" style="word-wrap: break-word;">
                {{$idpgoal->commitment}}
              </span>
            </div>
            <div class="panel-collapse collapse" id="pilotcollapsModal1{{$direct->id}}{{$idpgoal->id}}" aria-labelledby="pilotHeadingModal1{{$direct->id}}{{$idpgoal->id}}" role="tabpanel">
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-2 col-xs-12">
                    <h5>Objectvie</h5>
                  </div>
                  <div class="col-md-10 col-xs-12">
                    <ul>
                      <li style="word-wrap: break-word;">
                        {{$idpgoal->objective}}
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2 col-xs-12">
                    <h5>Employee Comments</h5>
                  </div>
                  <div class="col-md-10 col-xs-12">
                    <ul>
                      <li style="word-wrap: break-word;">
                        @if($idpgoal->emp_comment==NULL)
                        No comments yet.
                        @else
                        {{$idpgoal->emp_comment}}
                        @endif
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2 col-xs-12">
                    <h5>Line Manager Comment</h5>
                  </div>
                  <div class="col-md-10 col-xs-12">
                    <ul>
                      <li>
                        <?php $lmidcmt = app('App\Http\Controllers\LMController')->getCommentd($direct->id, $idpgoal->id); ?>
                        <br>
                        <p>
                          <a href="javascript:void(0)" onclick="editComm('cmak1{{$k}}{{$direct->id}}')" id="edit"><i class="icon wb-edit"></i></a>
                          <i class="hide" id="status{{$k}}"></i>
                        </p>
                        <div class="click2edit" id="cmak1{{$k}}{{$direct->id}}" empid="{{$direct->id}}" goalid="{{$idpgoal->id}}" style="word-wrap: break-word;">
                          @if(count($lmidcmt) > 0)
                          @if($lmidcmt->lm_comment != NULL)
                          {{$lmidcmt->lm_comment}}
                          @endif
                          @endif
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php $k+=1;?>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@else
<h4 class="text-danger">{{$direct->name}} has no development plans set.</h4>
@endif