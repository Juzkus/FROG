/***************************************

FROG DevSetup

Purpose/Problem Statement

This software is designed  to assist with
"dev-setup" through automation of  a well
defined set of steps within a given domain.

If there exists semi-reasonable 
documentation that details steps to be 
completed using a computer in order to
set up a working environment, this task
should be automated to the furthest degree
as it is a barrier to entry.

***************************************/
using System;
using System.Threading;
using System.Threading.Tasks;

namespace FROG.DevSetup
{
    class Program
    {
        static void Main(string[] args)
        {
            Console.WriteLine("FROG DevSetup");

            DevSetup ds = new DevSetup();
            ds.RunSetup();

            // wait
            Thread.Sleep(99999);
        }
    }
}
