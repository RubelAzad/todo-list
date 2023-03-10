
<div class="row align-items-center">
    <div class="col-lg order-lg-first">
        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
        <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link {{Request::is('/')?'active':''}}"><i class="fe fe-home"></i> Dashboard</a>
        </li>
        <li class="nav-item">
            <a href="{{route('task_category.index')}}" class="nav-link {{Request::is('categories')?'active':''}}"><i class="fe fe-calendar"></i>Tasks Categories</a>
        </li>
        <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link {{Request::is('tasks/*')?'active':''}}" data-toggle="dropdown"><i class="fe fe-box"></i> Tasks</a>
            <div class="dropdown-menu dropdown-menu-arrow">
                <a href="{{route('task.ongoing')}}" class="dropdown-item {{Request::is('tasks/ongoing')?'active':''}}">My Tasks</a>
                <a href="{{route('task.pending')}}" class="dropdown-item {{Request::is('tasks/pending')?'active':''}}">Pending Tasks</a>
                <a href="{{route('task.completed')}}" class="dropdown-item {{Request::is('tasks/completed')?'active':''}}">Completed Tasks</a>                      
            </div>
        </li>
        </ul>
    </div>
</div>