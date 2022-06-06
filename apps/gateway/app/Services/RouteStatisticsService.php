<?php

namespace App\Services;

use App\Models\RouteStatistic;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RouteStatisticsService
{
    /**
     * @var RouteStatistic
     */

    protected RouteStatistic $routeStatistic;

    /**
     * @param Request $request
     * @return RouteStatisticsService
     */

    public function findOrNew(Request $request): self
    {
        $this->routeStatistic = RouteStatistic::query()
            ->where('date', '>=', Carbon::now()->subHour()->toDateTimeString())
            ->where('date', '<=', Carbon::now()->toDateTimeString())
            ->where('method', $request->getMethod())
            ->where('route', $request->getRequestUri())
            ->when(Auth::check(), function (Builder $q) {
                return $q->whereHasMorph('userable', [User::class], function (Builder $q) {
                    $q->where('id', Auth::id());
                });
            }, function (Builder $q) use ($request) {
                return $q->where('ip', $request->getClientIp());
            })
            ->firstOrCreate(
                [
                    'method' => $request->getMethod(),
                    'route' => $request->getRequestUri(),
                    'ip' => $request->getClientIp(),
                ],
                [
                    'date' => Carbon::now(),
                ]
            );
        $this->routeStatistic->increment('counter');

        if (Auth::check()) {
            $this->routeStatistic->userable()->associate(Auth::user());
            $this->routeStatistic->save();
        }


        $this->incrementOrAssignAttributes(Arr::except($request->request->all(), config('routestatistics.excluded_parameters')), RouteStatistic::QUERY);
        $this->incrementOrAssignAttributes(optional($request->route())->parameters(), RouteStatistic::BIND);
        return $this;
    }

    /**
     * @param array $parameters
     * @param string $type
     * @return $this
     */

    public function incrementOrAssignAttributes(array $parameters, string $type): self
    {

        foreach ($parameters as $key => $value) {
            $this->routeStatistic
                ->parameters()
                ->where('type', $type)
                ->firstOrCreate([
                    'route_statistic_id' => $this->routeStatistic->id,
                    'type' => $type,
                    'key' => $this->getKeyByParameterType($type, $key, $value),
                    'value' => $this->getValueByParameterType($type, $key, $value)
                ])->increment('counter');
        }

        return $this;
    }

    /**
     * @param string $type
     * @param string $key
     * @param mixed $value
     * @return string
     */

    private function getKeyByParameterType(string $type, string $key, $value): string
    {
        if (($type === RouteStatistic::BIND) && $value instanceof Model) {
            return get_class($value);
        }

        return $key;
    }

    /**
     * @param string $type
     * @param string $key
     * @param mixed $value
     * @return string
     */


    private function getValueByParameterType($type, string $key, $value): string
    {
        if ($type === RouteStatistic::BIND && $value instanceof Model) {
            return $value->id;
        }

        return $value;
    }
}
