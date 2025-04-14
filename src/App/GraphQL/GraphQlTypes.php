<?php

namespace App\GraphQL;

use App\GraphQL\Types\UserType;
use App\GraphQL\Types\TeamType;
use App\GraphQL\Types\WorkerType;
use App\GraphQL\Types\WorkerRoleType;
use App\GraphQL\Types\ScheduleType;

use App\GraphQL\Types\DaysInScheduleType;
use App\GraphQL\Types\ManagerDaySettingsType;
use App\GraphQL\Types\WorkersWishesType;
use App\GraphQL\Types\ShiftsType;
use App\GraphQL\Types\WorkerRolePatternsType;
use App\GraphQL\Types\ShiftStatusesType;
use App\GraphQL\Types\ShiftSwapRequestsType;

class GraphQLTypes
{
    private UserType $userType;
    private TeamType $teamType;
    private WorkerType $workerType;
    private WorkerRoleType $workerRoleType;
    private ScheduleType $scheduleType;

    private DaysInScheduleType $daysInScheduleType;
    private ManagerDaySettingsType $managerDaySettingsType;
    private WorkersWishesType $workersWishesType;
    private ShiftsType $shiftsType;
    private WorkerRolePatternsType $workerRolePatternsType;
    private ShiftStatusesType $shiftStatusesType;
    private ShiftSwapRequestsType $shiftSwapRequestsType;

    public function __construct()
    {
        $this->userType = new UserType();
        $this->teamType = new TeamType($this);
        $this->workerRoleType = new WorkerRoleType($this);
        $this->workerType = new WorkerType($this);
        $this->scheduleType = new ScheduleType($this);

        
        $this->daysInScheduleType = new DaysInScheduleType($this);
        $this->managerDaySettingsType = new ManagerDaySettingsType($this);
        $this->workersWishesType = new WorkersWishesType($this);
        $this->shiftsType = new ShiftsType($this);
        $this->workerRolePatternsType = new WorkerRolePatternsType($this);
        $this->shiftStatusesType = new ShiftStatusesType();
        $this->shiftSwapRequestsType = new ShiftSwapRequestsType($this);
    }

    public function user(): UserType
    {
        return $this->userType;
    }

    public function team(): TeamType
    {
        return $this->teamType;
    }

    public function worker(): WorkerType
    {
        return $this->workerType;
    }

    public function workerRole(): WorkerRoleType
    {
        return $this->workerRoleType;
    }

    public function schedule(): ScheduleType
    {
        return $this->scheduleType;
    }

    // 🆕 Новые геттеры
    public function daysInSchedule(): DaysInScheduleType
    {
        return $this->daysInScheduleType;
    }

    public function managerDaySettings(): ManagerDaySettingsType
    {
        return $this->managerDaySettingsType;
    }

    public function workersWishes(): WorkersWishesType
    {
        return $this->workersWishesType;
    }

    public function shifts(): ShiftsType
    {
        return $this->shiftsType;
    }

    public function workerRolePatterns(): WorkerRolePatternsType
    {
        return $this->workerRolePatternsType;
    }

    public function shiftStatuses(): ShiftStatusesType
    {
        return $this->shiftStatusesType;
    }

    public function shiftSwapRequests(): ShiftSwapRequestsType
    {
        return $this->shiftSwapRequestsType;
    }
}
