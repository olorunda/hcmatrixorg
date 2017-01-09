<?php 
$cras = app('App\Repositories\EmployeeRepository')->getGoalTo(Auth::user()->id, $direct->id, 4); 
$cracnt = count($cras); 
?>
@if($cracnt > 0)
<div class="row row-lg">
  <div class="col-md-12 col-xs-12">
    <div class="panel panel-bordered" style="margin-bottom: 4px;">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-line-chart"></i> Individual Development Plans</h3>
      </div>
      <div class="panel-body">
        <div class="panel-group panel-group-simple" id="career{{$direct->id}}" aria-multiselectable="true" role="tablist">
          @foreach($cras as $cra)
          <div class="panel">
            <div class="panel-heading" id="pilotHeadingModal1{{$direct->id}}{{$cra->id}}" role="tab">
              <a class="panel-title" data-toggle="collapse" href="#pilotcollapsModal1{{$direct->id}}{{$cra->id}}" data-parent="#career{{$direct->id}}" aria-expanded="false" aria-controls="pilotcollapsModal1{{$direct->id}}{{$cra->id}}">
                <h5 class="text-warning">Commitment</h5>
              </a>
              <span class="text-default" style="word-wrap: break-word;">
                {{$cra->commitment}}
              </span>
            </div>
            <div class="panel-collapse collapse" id="pilotcollapsModal1{{$direct->id}}{{$cra->id}}" aria-labelledby="pilotHeadingModal1{{$direct->id}}{{$cra->id}}" role="tabpanel">
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-2 col-xs-12">
                    <h5>Objectvie</h5>
                  </div>
                  <div class="col-md-10 col-xs-12">
                    <ul>
                      <li style="word-wrap: break-word;">
                        {{$cra->objective}}
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
                        @if($cra->emp_comment==NULL)
                        No comments yet.
                        @else
                        {{$cra->emp_comment}}
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
                        <?php $lmcracmt = app('App\Http\Controllers\LMController')->getCommentd($direct->id, $cra->id); ?>
                        <br>
                        <p>
                          <a href="javascript:void(0)" onclick="editComm('cmal1{{$l}}{{$direct->id}}')" id="edit"><i class="icon wb-edit"></i></a>
                          <i class="hide" id="status{{$l}}"></i>
                        </p>
                        <div class="click2edit" id="cmal1{{$l}}{{$direct->id}}" empid="{{$direct->id}}" goalid="{{$cra->id}}" style="word-wrap: break-word;">
                        @if(count($lmcracmt) > 0)
                        @if($lmcracmt->lm_comment != NULL)
                        {{$lmcracmt->lm_comment}}
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
<h4 class="text-danger">{{$direct->name}} has no career aspirations set.</h4>
@endif