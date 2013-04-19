//
//  MasterViewController.h
//  VirtualCallBoard
//
//  Created by Ryan Hess on 4/19/13.
//  Copyright (c) 2013 Ryan Hess. All rights reserved.
//

#import <UIKit/UIKit.h>

@class DetailViewController;

@interface MasterViewController : UITableViewController

@property (strong, nonatomic) DetailViewController *detailViewController;

@end
