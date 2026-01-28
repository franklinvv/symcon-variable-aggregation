# IP-Symcon Variable Aggregation

A collection of IP-Symcon modules for aggregating multiple variables into single calculated values.

## Overview

This library provides modules that monitor multiple IP-Symcon variables and automatically calculate aggregated values whenever the source variables are updated. All modules filter out stale data (older than 6 hours) to ensure reliable results.

## Modules

### AverageValue

Calculates a weighted average from multiple float variables.

**Features:**
- Weighted averaging of multiple float variables
- Automatic updates when any monitored variable changes
- Configurable weights for each variable
- Filters out variables older than 6 hours
- Creates an "Average" output variable

**Use Cases:**
- Average temperature across multiple sensors
- Weighted average of sensor readings
- Combining multiple measurements with different importance levels

[More details](AverageValue/)

### MaxValue

Finds the maximum value from multiple integer variables.

**Features:**
- Tracks the maximum value across multiple integer variables
- Automatic updates when any monitored variable changes
- Filters out variables older than 6 hours
- Creates a "Max" output variable

**Use Cases:**
- Maximum temperature across multiple rooms
- Peak values from multiple sensors
- Highest reading from a sensor array

[More details](MaxValue/)

## Requirements

- IP-Symcon version 5.0 or higher

## Installation

### Via Module Store

1. Open the IP-Symcon Management Console
2. Navigate to the Module Store
3. Search for "VariableAggregation"
4. Click Install

### Via Module Control

1. Open the IP-Symcon Management Console
2. Navigate to Module Control
3. Add the following repository URL:
   ```
   https://github.com/franklinvv/symcon-variable-aggregation
   ```

## Configuration

### AverageValue Module

1. In IP-Symcon, go to "Add Instance"
2. Select "AverageValue" under the vendor "Franklin van Velthuizen"
3. Configure the module:
   - Add the variables you want to average
   - Set the weight for each variable (variables with higher weights have more influence)
4. The module creates an "Average" variable that updates automatically

### MaxValue Module

1. In IP-Symcon, go to "Add Instance"
2. Select "MaxValue" under the vendor "Franklin van Velthuizen"
3. Configure the module:
   - Add the variables you want to track
4. The module creates a "Max" variable that updates automatically

## How It Works

Both modules use the IP-Symcon message system to monitor variable updates:

1. When configured, modules register to receive update messages from the specified variables
2. Whenever a monitored variable changes, the module recalculates the result
3. Variables older than 6 hours are automatically excluded from calculations
4. The result is written to the output variable (Average or Max)

## License

This project is licensed under the GNU General Public License v3.0 - see the [LICENSE](LICENSE) file for details.

## Author

Franklin van Velthuizen

Website: https://www.yoki.org/

## Contributing

Contributions are welcome! Please feel free to submit issues or pull requests.
